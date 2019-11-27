$(function(){
    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf:'http://www.blog.com/static/admin/assets/css/webuploader/Uploader.swf',

        // 文件接收服务端。
        server: '/admin/uploadFile',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },

        //带上csrf token
        formData: {
            // 这里的token是外部生成的长期有效的，如果把token写死，是可以上传的。
            _token:$("meta[name='x-csrf-token']").attr('content')
            // 我想上传时再请求服务器返回token，改怎么做呢？反复尝试而不得。谢谢大家了！
            //uptoken_url: '127.0.0.1:8080/examples/upload_token.php'
        },

    });


// 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
            '<div id="' + file.id + '" class="file-item thumbnail">' +
            '<img>' +
            '<div class="info">' + file.name + '</div>' +
            '</div>'
            ),
            $img = $li.find('img');



        //这四个代码一定要加上，文档没有写，start
        var $list = $("#fileList");
        var uploadimgWidth = $('#uploadimg').width();
        var thumbnailWidth = 0.235 * uploadimgWidth;
        var thumbnailHeight = thumbnailWidth;
        //这四个代码一定要加上end


        // $list为容器jQuery实例
        $list.append( $li );



        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, thumbnailWidth, thumbnailHeight );
    });


// 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                .appendTo( $li )
                .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

// 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file,response) {
        if(response) {
            if(response.status === '000'){
                $("#image").attr('value',response.data.filePath);
                layer.msg('上传成功',{icon:1});
            } else {
                layer.msg('上传失败',{icon:2});
            }
        }
        $( '#'+file.id ).addClass('upload-state-done');
    });


// 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

// 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });

});
