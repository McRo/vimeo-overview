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
    // elt.find(".id").html(data.uri);

    // upload date format yyyy-MM-dd'T'HH:mm:ssXXX (2021-09-14T12:27:59+00:00)
    elt.find(".upload_date").html(data.created_time.split("T")[0]);

    // nmae
    elt.find(".name").html(data.name);

    // duration in second to hh:mm:ss
    var duration = new Date(0);
    duration.setSeconds(data.duration); // transform to 1970-01-01T00:30:00.000Z
    var duration = duration.toISOString().substr(11, 8); // take only time info
    elt.find(".duration").html(duration);

    elt.find(".password").html(data.password);

    // links
    elt.find(".links").append("<a href='"+data.link+"' target='_blank'>vimeo</a> ");
    data.files.forEach((file, item) =>  {

        elt.find(".links").append("<a href='"+file.link+"' target='_blank'>"+file.quality+"</a> ");

    })
    elt.find(".privacy").html(data.privacy.view);
    elt.find(".manage").html("<a href='https://vimeo.com"+data.manage_link+"' target='_blank'>manage</a>");

}
