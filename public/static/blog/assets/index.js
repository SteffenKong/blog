$(function() {
    getTags();
    getLinks();
    getArticleByRec();
    getCates();
});

/**
 * 获取标签
 */
function getTags() {
    $.ajax({
        url:'/blog/getTagsCloud',
        dataType:'Json',
        type:'GET',
        success:function(resp) {
            if(resp.status == '000') {
                allAobj = '';
                colorList = ['#FF5722','#FFB800','#2F4056','#01AAED','#1E9FFF','#009688','#393D49'];
                for(var i = 0;i<resp.data.tags.length;i++) {
                    let tagObj = '<a href="/blog/getListByTagId/'+resp.data.tags[i].id+'" class="tagCloud" style="background-color: '+colorList[i]+';">'+resp.data.tags[i].title+'</a>';
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
 * 获取推荐文章
 */
function getArticleByRec() {
    $.ajax({
        url:'/blog/getRec',
        dataType:'Json',
        type:'GET',
        success:function(resp) {
            if(resp.status == '000')    {
                for(var i = 0;i<resp.data.articles.length;i++) {
                    let liObj = '<li><a href="#">'+resp.data.articles[i].title+'</a> <span style="float:right; position: relative; bottom:30px; right:20px; font-size:8px; color:grey;">'+resp.data.articles[i].viewNumber+' 点击量</span> </li>';
                    $("#rec").append(liObj);
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
                    let liObj = '<li><a href="'+resp.data.cates[i].title+'">'+resp.data.cates[i].title+'</a>';
                    $("#cates").append(liObj);
                }
            }else {
                layer.msg('数据获取失败',{icon:2});
            }
        }
    })
}

