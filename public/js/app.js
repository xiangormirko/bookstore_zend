
$(document).ready(function() {
    $('form').submit( function(evt) {

        // prevent default redirect and get value from form
        evt.preventDefault();
        var keyword = $('#search').val();
        var $targetElement = $('article.book-table');
        $targetElement.empty();

        // ajax to get the table of books based on search
        $.post('ajaxtable',
            {'keyword':keyword},
            function (response) {
                var url = 'ajaxtable/keyword/' + encodeURI(keyword)
                var $banner = $('#fortable');
                $banner.empty();
                $banner.load(url + ' #bookTableAll');
            }
        );

        // ajax request to create thumbnails based on search
        $.post('ajax',
            {'keyword':keyword},
            function (response) {

                var jsonObject = $.parseJSON(response); //Parse into json Objects
                //var $targetElement = $('article.book-table');
                //$targetElement.empty();


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

        ) //end Post Ajax


    }); //end submit


    // lightbox image implementation
    var $overlay = $('<div id="overlay"></div>');
    var $image = $("<img>");

    $overlay.append($image);
    $("body").append($overlay);

    $('body').on('click', 'td img', function(event){
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

    $( "#bookTableAll" ).click(function(){
        //Hide the overlay
        $( "#bookTableAll" ).tablesorter();
    });




}); //end ready