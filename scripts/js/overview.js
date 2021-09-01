var vimeo_baseurl = "/me/videos/";
var page = 1;
var paging = 10;

$(function() {

    init();    

})


function duplicate(){

    var clone = $(".baseline").clone()
                            .removeClass("baseline")
                            .addClass("video");
    $(".baseline").parent().append(clone);
    return clone

}

function init() {
    // console.log("init")
    getData();


}


function getData(){
    var url = "scripts/php/getVideo.php";
    /*
    if(uri.indexOf("20")>=0){
        return
    }
    */
    $.post(url, {"uri":vimeo_baseurl, "paging": paging, "page": page },
        function(response){

            console.log(response); 

            var data = response.body.data;
            var paging = response.body.paging;
            var next = paging.next;
                
            data.forEach((video, index) => {

                elt = duplicate();
                displayInfos(elt, video)
            })
            if(next){
                page++;
                getData();
            }


        },
        "json"

    )

}


function displayInfos(elt, data){
    // console.log(data)
    elt.find(".id").html(data.uri);
    elt.find(".name").html(data.name);
    elt.find(".password").html(data.password);
    elt.find(".links").append("<a href='"+data.link+"' target='_blank'>vimeo</a> ");
    data.files.forEach((file, item) =>  {
        
        elt.find(".links").append("<a href='"+file.link+"' target='_blank'>"+file.quality+"</a> ");

    })
    elt.find(".privacy").html(data.privacy.view);
    elt.find(".manage").html("<a href='https://vimeo.com"+data.manage_link+"' target='_blank'>manage</a>");

}


