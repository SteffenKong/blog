$(function() {
    getCates();
    getTagByIndex();
    getTagsByCloud();
    getLinks();
    getArticleByRec();
    getBanner();
});


/**
 * 获取首页横幅
 */
function getBanner() {
    $.ajax({
        url:'/blog/getBanner',
        dataType:'Json',
        type:'GET',
        success:function(resp) {
            if(resp.status === '000') {
                for (var i = 0;i < resp.data.banner.length;i++) {
                    if(i == 0) {
                        var itemObj = '<div class="item active"> <a href="" target="_blank"><img src="'+resp.data.banner[i].image+'" alt="" class="img-responsive"></a></div>';
                        var btnObj = '<li data-target="#focusslide" data-slide-to="'+i+'" class="active"></li>';
                    }else {
                        var itemObj = '<div class="item"> <a href="" target="_blank"><img src="'+resp.data.banner[i].image+'" alt="" class="img-responsive"></a></div>';
                        var btnObj = '<li data-target="#focusslide" data-slide-to="'+i+'"></li>';
                    }
                    $("#bannerBox").append(itemObj);

                    $("#banner_btn").append(btnObj);
                }
            }
        }
    })
}



/**
 * 获取标签
 */
function getTagsByCloud() {
    $.ajax({
        url:'/blog/getTagsCloud',
        dataType:'Json',
        type:'GET',
        success:function(resp) {
            if(resp.status == '000') {
                allAobj = '';
                colorList = ['#FF5722','#FFB800','#2F4056','#01AAED','#1E9FFF','#009688','#393D49'];
                for(var i = 0;i<resp.data.tags.length;i++) {
                    var colorListIndex = Math.round(Math.random()*colorList.length);
                    if(!colorList[colorListIndex]) {
                        colorListIndex = 3;
                    }
                    let tagObj = '<a href="/blog/getListByTagId/'+resp.data.tags[i].id+'" class="tagCloud" style="background-color: '+colorList[colorListIndex]+';">'+resp.data.tags[i].title+'</a>';
                    allAobj += tagObj;
                }
                $("#tag").append(allAobj);
            }else {
                layer.msg('数据获取失败',{icon:2});
            }
        }
    })
}


/**
 * 首页更多位置标签
 */
function getTagByIndex() {
    $.ajax({
        url:'/blog/getTagByIndex',
        dataType:'Json',
        type:'GET',
        success:function(resp) {
            var allAobj = '';
            if(resp.status === '000') {
                for(var i = 0;i<resp.data.tag.length;i++) {
                    let tagObj = '<a href="/blog/getListByTagId/'+resp.data.tag[i].id+'" class="tagCloud">'+resp.data.tag[i].title+'</a>';
                    allAobj += tagObj;
                }
                $(".more").append(allAobj);
            }else {
                layer.msg('数据获取失败',{icon:2});
            }
        }
    })
}

/**colorListIndex
 * 获取推荐文章
 */
function getArticleByRec() {
    $.ajax({
        url:'/blog/getRec',
        dataType:'Json',
        type:'GET',
        success:function(resp) {
            if(resp.status == '000')    {
                console.log(resp.data)
                for(var i = 0;i<resp.data.articles.length;i++) {
                    let liObj = '<li><a href=""><span class="thumbnail"><img class="thumb" data-original="'+resp.data.articles[i].smallImage+'" src="'+resp.data.articles[i].smallImage+'" alt=""> </span><span class="text">'+resp.data.articles[i].title+'</span><span class="muted"><i class="glyphicon glyphicon-time"></i>'+resp.data.articles[i].createdAt+'</span><span class="muted"> <i class="glyphicon glyphicon-eye-open"></i> '+resp.data.articles[i].viewNumber+'</span></a></li>';
                    $(".rec").append(liObj);
                }
            }else {
                layer.msg('数据获取失败',{icon:2});
            }
        }
    })
}


/**
 * 获取友情链接
 */
function getLinks() {
    $.ajax({
        url:'/blog/getLinks',
        dataType:'Json',
        type:'GET',
        success:function(resp) {
            if(resp.status == '000') {
                for(var i = 0;i<resp.data.links.length;i++) {
                    let liObj = '<li><a href="'+resp.data.links[i].url+'">'+resp.data.links[i].title+'</a>';
                    $("#linkList").append(liObj);
                }
            }else {
                layer.msg('数据获取失败',{icon:2});
            }
        }
    })
}


/**
 * 获取分类
 */
function getCates() {
    $.ajax({
        url:'/blog/getCates',
        dataType:'Json',
        type:'GET',
        success:function(resp) {
            if(resp.status == '000') {
                for(var i = 0;i<resp.data.cates.length;i++) {
                    let liObj = '<li><a href="/blog/getListByCateId/'+resp.data.cates[i].id+'">'+resp.data.cates[i].title+'</a></li>';
                    $(".navbar-nav").append(liObj);
                }
            }else {
                layer.msg('数据获取失败',{icon:2});
            }
        }
    })
}

