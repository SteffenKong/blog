$(function() {
   var articleId = $("#articleId").attr("data-id");

   $.ajax({
       url:"/blog/getArticle/"+articleId,
       data:null,
       dataType:"Json",
       type:"GET",
       success:function(resp) {
           if(resp.status === '000') {
               console.log(resp.data)
               $(".am-article-title").text(resp.data.title);
               $("#title").text(resp.data.title);
               $("#author").text(resp.data.author);
               $("#description").text(resp.data.description);
               $("#image").attr('src',resp.data.smallImage);
               $("#viewNumber").text(resp.data.viewNumber);
               $("#article>p").html(resp.data.content);
           }else {
               location.href = '/blog/index';
           }
       }
   })
});
