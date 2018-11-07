
function isInt(value) {
  return !isNaN(value) && 
         parseInt(Number(value)) == value && 
         !isNaN(parseInt(value, 10));
};

function SummerNoteBlogNew(){

        $("#titleNew.summernote").summernote({

            placeholder: "Input your Title here",

            font: ['comic sans']

        });

        $("#bodyNew.summernote").summernote({

            placeholder: "Input your Title here",

            font: ['comic sans']

        });


    };



function CreateNewBlog (title, body){

        var passdata = {

            "title":encodeURIComponent(title),
            "body": encodeURIComponent(body)  

        };

        var json = JSON.stringify(passdata);
        

        $.ajax({


            type: "POST",
            url: 'inc/BlogCreateBody.php',
            data: {jsonData: json}, 
            dataType: 'text',               
            success: function(results){

                console.log(results);

            },
            error: function(error, errorThrown){
                console.log(error);
                console.log(errorThrown);

            }

        });


    };

    function SummerNote(){

        $("#title.summernote").summernote({

            font: ['Comic sans'],
            
            callbacks: {
                 onBlur: function() {
                    console.log('Editable area loses focus');
                    var passdata = {

                        "id":   $(this).prev("input#id").val(),
                        "title":    encodeURIComponent($(this).summernote('code'))  

                    };

                    var json = JSON.stringify(passdata);
                    

                    $.ajax({


                        type: "POST",
                        url: 'inc/BlogUpdateTitle.php',
                        data: {jsonData: json}, 
                        dataType: 'text',               
                        success: function(results){

                            console.log(results);

                        },
                        error: function(error, errorThrown){
                            console.log(error);
                            console.log(errorThrown);

                        }

                    });

                }
      }

        });

        



     

        $("#body.summernote").summernote({

            font: ['Comic sans'],
            
            placeholder: 'Body Here',
            callbacks: {
                    onBlur: function() {
                            console.log('Editable area loses focus');
                            var passdata = {

                                "id":   $(this).prevAll("input#id").val(),
                                "body": encodeURIComponent($(this).summernote('code'))  

                            };

                            var json = JSON.stringify(passdata);
                            

                            $.ajax({


                                type: "POST",
                                url: 'inc/BlogUpdateBody.php',
                                data: {jsonData: json}, 
                                dataType: 'text',               
                                success: function(results){

                                    console.log(results);

                                },
                                error: function(error, errorThrown){
                                    console.log(error);
                                    console.log(errorThrown);

                                }

                            });

                        }

                    }   

        });

    };


function titleEdit(){

 $("#titleEdit.summernote").summernote({

            font: ['Comic sans'],
            
            callbacks: {
                 onBlur: function() {
                    console.log('Editable area loses focus');
                    var passdata = {

                        "id":   $(this).prev("input#id").val(),
                        "title":    encodeURIComponent($(this).summernote('code'))  

                    };

                    var json = JSON.stringify(passdata);
                    

                    $.ajax({


                        type: "POST",
                        url: 'inc/BlogUpdateTitle.php',
                        data: {jsonData: json}, 
                        dataType: 'text',               
                        success: function(results){

                            console.log(results);

                        },
                        error: function(error, errorThrown){
                            console.log(error);
                            console.log(errorThrown);

                        }

                    });

                },

                onChange: function(){

                        console.log('The on change is going off');

                        var code = $(this).summernote('code');

                        

                        $(this).parents("div#outerDiv").find("div#titleLive").html(code);



                    }

      }

        });


};

function bodyEdit(){

    $("#bodyEdit.summernote").summernote({

            font: ['Comic sans'],
            
            placeholder: 'Body Here',
            callbacks: {
                    onBlur: function() {
                            console.log('Editable area loses focus');
                            var passdata = {

                                "id":   $(this).prevAll("input#id").val(),
                                "body": encodeURIComponent($(this).summernote('code'))  

                            };

                            var json = JSON.stringify(passdata);
                            

                            $.ajax({


                                type: "POST",
                                url: 'inc/BlogUpdateBody.php',
                                data: {jsonData: json}, 
                                dataType: 'text',               
                                success: function(results){

                                    console.log(results);

                                },
                                error: function(error, errorThrown){
                                    console.log(error);
                                    console.log(errorThrown);

                                }

                            });

                        }

                    }   

        });


};

function deleteBlog(id){

    if(isInt(id)){

        var passdata = {"id": id};

        var json = JSON.stringify(passdata);

        $.ajax({

            type:"POST",
            url:"inc/BlogDelete.php",
            data: {jsonData: json},
            dataType: 'text',
            success: function(results){

                console.log(results);

            },
            error: function(error, errorThrown){

                    console.log(error);
                    console.log(errorThrown);

            }

        });

    }else{

        console.log("That wasn't an integer");

    }


};


