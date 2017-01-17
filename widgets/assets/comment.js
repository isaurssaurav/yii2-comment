 var offset = 0;
    $(document).on("click","#loadMoreComment",function(){
        //alert("hello");
        var obj = $(this);
        offset = offset + obj.data("limit");
        totalcomment = obj.data("totalcomment");
        console.log(offset);
        console.log(totalcomment);
        
        $.ajax({
            type:"POST",
            url:$(this).data("post-url"),
            data:{offset:offset,recognize_schema:obj.data("url"),sort:obj.data("sort"),limit:obj.data("limit")},
            success:function(response){
                $("#commentdiv").append(response);
                if(offset+1 >= totalcomment){
                    obj.remove();
                }
            }
        });

    }) ;


   $(document).on("click",".post-button",function(ev){
        $.ajax({
            type:"POST",
            url:$(this).data("post-url"),
            data:$("#postCommentForm").serialize()+ "&recognize_schema=" + $(this).data("recognize-schema"),
            dataType:"JSON",
            success:function(response){
                if(response.status == true){
                    $.pjax.reload({container: "#pjax-comment-div", timeout: 2000});
                }else{
                    $(".comment-message").text(response.message);
                }    
            }
        });

   });
   $(document).on("click",".sort-comment",function(){
           $.ajax({
            type:"POST",
            url:$(this).data("url"),
            data:{"sort" : $(this).data("sort")},
            dataType:"JSON",
            success:function(){
                $.pjax.reload({container: "#pjax-comment-div", timeout: 2000});   
            }
        });
   });

    $(document).on("click",".comment-reply-btn",function(){
        var parent_id = $(this).data("parent-id");
        $(".comment-reply-div-"+parent_id).toggle();
    });

    $(document).on("click",".post-reply-button",function(){
        var target_id = $(this).data("parent-id");
        var obj =$(this); 
         $.ajax({
            type:"POST",
            url:$(this).data("post-url"),
            data:$("#postCommentReplyForm"+target_id).serialize()+ "&recognize_schema=" + $(this).data("recognize-schema") 
                + "&parent_id=" + $(this).data("parent-id"),
            dataType:"JSON",
            success:function(response){
                if(response.status == true){
                    $.pjax.reload({container: "#pjax-comment-div", timeout: 2000});
                }else{
                    alert(response.message);
                    //console.log(obj.parent().find(".reply-comment-message"));
                   obj.parent().siblings(".reply-comment-message").text(response.message);
                }    
            }
        });
        });
