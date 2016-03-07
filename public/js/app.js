
$(document).ready(function() {
    $('form').submit( function(evt) {
        evt.preventDefault();
        var keyword = $('#search').val();
        console.log(keyword);

        $.post('ajax',
            {'keyword':keyword},
            function (response) {
                console.log("got it!!");

                var jsonObject = $.parseJSON(response); //Parse into json Objects
                $('article.book-table').empty();

                $.each(jsonObject, function (i, obj) {

                    var $targetElement = $('article.book-table');

                    // Construct Table thumbnails
                    $targetElement.append(
                        $('<div/>', {'class': 'thumbnail'}).append(
                            $('<table/>').append(
                                $('<thead/>').append($('<tr>').append(
                                    $('<th/>', {'class': 'table-top', 'colspan': '2', 'text': 'cover'})))
                            ).append(
                                $('<tbody/>').append(
                                    $('<tr/>', {'class': 'data'}).append(
                                        $('<td/>', {'colspan': '2'}).append(
                                            $('<img/>', {'width': '200', 'src': '/'+obj.image_url})
                                        )
                                    )
                                ).append(
                                    $('<tr/>', {'class': 'data'}).append(
                                        $('<td/>', {'colspan': '2', 'calss': 'img-url'}).append(
                                            $('<a/>', {'href': './detail/id/'+ obj.item_id, 'text': obj.image_url})
                                        )
                                    )
                                ).append(
                                    $('<tr/>', {'class': 'data'}).append(
                                        $('<th/>', {'scope': 'row', 'text': 'Title'})
                                    ).append(
                                        $('<td/>').append($('<a/>', {'href': './detail/id/'+ obj.item_id, 'text': obj.name}))
                                    )
                                ).append(
                                    $('<tr/>', {'class': 'data'}).append(
                                        $('<th/>', {'scope': 'row', 'text': 'Author'})
                                    ).append(
                                        $('<td/>', {'text': obj.author})
                                    )
                                ).append(
                                    $('<tr/>', {'class': 'data'}).append(
                                        $('<th/>', {'scope': 'row', 'text': 'Price'})
                                    ).append(
                                        $('<td/>', {'text': '$ '+obj.price})
                                    )
                                ).append(
                                    $('<tr/>', {'class': 'data'}).append(
                                        $('<th/>', {'scope': 'row', 'text': 'Catergory'})
                                    ).append(
                                        $('<td/>', {'text': obj.category_id})
                                    )
                                )
                            )
                        )

                    );

                });
            }

        )

    }); //end submit

    var $overlay = $('<div id="overlay"></div>');
    var $image = $("<img>");

    $overlay.append($image);
    $("body").append($overlay);

    $('body').on('click', 'img', function(event){
        event.preventDefault();
        var imageLocation = $(this).attr("src");
        //Update overlay with the image linked in the link
        console.log(imageLocation)

        $image.attr("src", imageLocation);

        //Show the overlay.
        $overlay.show();


    });

//When overlay is clicked
    $overlay.click(function(){
        //Hide the overlay
        $overlay.hide();
    });

}); //end ready