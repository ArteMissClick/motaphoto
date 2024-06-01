jQuery(document).ready(function($) {
    let page = 2; // Initialize to 2 since we're now starting from the second page
    let isLoading = false; // Flag to prevent duplicate requests

    // Define loadPhotos globally
    window.loadPhotos = function(reset = false) {
        if (reset) {
            page = 1; // Reset the page number when filters are changed
            $('#photo-gallery').empty(); // Clear the photo gallery
            $('#load-more').show(); // Ensure the "load more" button is visible
            $('#no-more-photos').hide(); // Hide the "no more photos" indicator
        }

        if (isLoading) {
            return; // Prevent duplicate requests
        }

        isLoading = true;
        console.log('Requesting page:', page); // Log the requested page number

        var data = {
            'action': 'load_more_photos',
            'page': page,
            'category': $('#category-filter').val(),
            'format': $('#format-filter').val(),
            'sort': $('#sort-filter').val()
        };

        $.post(motaphoto_ajax_params.ajax_url, data, function(response) {
            isLoading = false; // Reset loading flag
            if (response.trim() === 'no_more_photos') {
                if (reset) {
                    $('#photo-gallery').html('<p>No photos found</p>'); // Display a message
                } else {
                    $('#load-more').hide();
                    $('#no-more-photos').show();
                }
            } else {
                if (reset) {
                    $('#photo-gallery').html(response);
                } else {
                    $('#photo-gallery').append(response);
                }

                console.log('Loaded page:', page); // Log the loaded page number
                page++; // Increment the page number for the next request
                console.log('Next page will be:', page); // Log the next page number

                initLightbox(); // Recollect photos and reattach events
                attachEyesClickEvent(); // Reattach events for .eyes
            }
        });
    };

    $('#category-filter, #format-filter, #sort-filter').on('change', function() {
        loadPhotos(true);
    });

    // Remove previous click event handlers to prevent duplicate bindings
    $('#load-more').off('click').on('click', function() {
        console.log('Load more button clicked'); // Log the click event
        loadPhotos();
    });

    // Function to attach click events to .eyes
    function attachEyesClickEvent() {
        $('.eyes').off('click').on('click', function() {
            const postUrl = $(this).data('url');
            window.location.href = postUrl;
        });
    }

    // Initial call to attach click events
    attachEyesClickEvent();
});