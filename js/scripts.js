document.addEventListener('DOMContentLoaded', function () {
    jQuery(function ($) {

        let photos = [];
        var page = 2; // Assuming the first page has already been loaded
        var isLoading = false; // Flag to prevent duplicate requests

        // Define the function globally
        window.initLightbox = function() {
            const lightbox = $('#lightbox');
            const lightboxImage = $('#lightbox-image');
            const prevPhoto = $('.contain-left');
            const nextPhoto = $('.contain-right');
            let currentIndex = 0;

            function collectPhotos() {
                photos = [];
                $('.photo-block-wrapper .other-photo').each(function () {
                    const src = $(this).attr('src');
                    if (src && src.startsWith('http')) {
                        photos.push(src);
                    }
                });
                console.log('Photos array:', photos);
            }

            function attachEvents() {
                $('.show-photo').off('click').on('click', function () {
                    const otherPhoto = $(this).closest('.photo-block').find('.other-photo').attr('src');
                    lightbox.css('display', 'flex');
                    lightboxImage.attr('src', otherPhoto);
                    currentIndex = photos.indexOf(otherPhoto);
                    console.log('Current photo index:', currentIndex);
                });

                if (nextPhoto.length) {
                    nextPhoto.off('click').on('click', function () {
                        currentIndex = (currentIndex + 1) % photos.length;
                        lightboxImage.attr('src', photos[currentIndex]);
                        console.log('Next photo index:', currentIndex);
                    });
                }

                if (prevPhoto.length) {
                    prevPhoto.off('click').on('click', function () {
                        currentIndex = (currentIndex - 1 + photos.length) % photos.length;
                        lightboxImage.attr('src', photos[currentIndex]);
                        console.log('Previous photo index:', currentIndex);
                    });
                }

                $('.close-lightbox').off('click').on('click', closeLightbox);
                
                $('.eyes').off('click').on('click', function () {
                    const postUrl = $(this).data('url');
                    window.location.href = postUrl;
                });
            }

            function closeLightbox() {
                lightbox.css('display', 'none');
            }

            $(window).on('click', function (event) {
                if ($(event.target).is('#myModal')) {
                    $('#myModal').css('display', 'none');
                } else if ($(event.target).is(lightbox)) {
                    closeLightbox();
                }
            });

            collectPhotos();
            attachEvents();
        };

        function initModal() {
            const modal = $('#myModal');
            const btn = $('#menu-item-9');
            const btn2 = $('#singleContact');

            function showModal() {
                modal.css('display', 'flex');
            }

            if (btn.length) btn.on('click', showModal);
            if (btn2.length) btn2.on('click', showModal);
        }

        function initRedirection() {
            $('.eyes').on('click', function () {
                const postUrl = $(this).data('url');
                window.location.href = postUrl;
            });
        }

        function handleReferenceElement() {
            const maReferenceElement = $('#maReference');
            let maReference = '';

            if (maReferenceElement.length) {
                maReference = maReferenceElement.text();
                console.log('Reference:', maReference);
            } else {
                console.log('Element with id "maReference" not found');
            }

            $(document).ready(function () {
                $(".champs-ref").val(maReference);
            });
        }

        function initSinglePhotoHoverEffects() {
            const arrowRight = $(".arrow-right");
            const arrowLeft = $(".arrow-left");
            const photoNext = $(".photo-next");
            const photoPrev = $(".photo-prev");
            const arrowsAlone = $(".arrows");

            if (arrowRight.length) {
                arrowRight.on('mouseover', function () {
                    if (photoNext.length && arrowsAlone.length) {
                        photoNext.addClass('active-img');
                        arrowsAlone.removeClass('arrows-alone');
                    }
                });

                arrowRight.on('mouseout', function () {
                    if (photoNext.length && arrowsAlone.length) {
                        photoNext.removeClass('active-img');
                        arrowsAlone.addClass('arrows-alone');
                    }
                });
            }

            if (arrowLeft.length) {
                arrowLeft.on('mouseover', function () {
                    if (photoPrev.length && arrowsAlone.length) {
                        photoPrev.addClass('active-img');
                        arrowsAlone.removeClass('arrows-alone');
                    }
                });

                arrowLeft.on('mouseout', function () {
                    if (photoPrev.length && arrowsAlone.length) {
                        photoPrev.removeClass('active-img');
                        arrowsAlone.addClass('arrows-alone');
                    }
                });
            }
        }

        function initLoadMore() {
            $('#load-more').off('click').on('click', function() {
                console.log('Load more button clicked'); // Log the click event
                loadPhotos();
            });
        }

        // Initialize functions
        initLightbox();
        initModal();
        initRedirection();
        handleReferenceElement();
        initSinglePhotoHoverEffects();
        initLoadMore();

    });
});









// document.addEventListener('DOMContentLoaded', function () {
//     jQuery(function ($) {

//         function initLightbox() {
//             const lightbox = $('#lightbox');
//             const lightboxImage = $('#lightbox-image');
//             const prevPhoto = $('.contain-left');
//             const nextPhoto = $('.contain-right');
//             let currentIndex = 0;
//             let photos = [];

//             // Collect all photo URLs from the photo blocks
//             $('.photo-block .other-photo').each(function () {
//                 const img = $(this);
//                 const src = img.attr('src');
//                 console.log('Image found:', src); // Log each image found
                
//                 // Only add images that are fully loaded and have a valid HTTP URL
//                 if (src && src.startsWith('http')) {
//                     if (img[0].complete && img[0].naturalHeight !== 0) {
//                         photos.push(src);
//                     } else {
//                         img.on('load', function () {
//                             photos.push(src);
//                         });
//                     }
//                 }
//             });

//             console.log('Photos array:', photos);

//             $('.show-photo').on('click', function () {
//                 const otherPhoto = $(this).closest('.photo-block').find('.other-photo').attr('src');
//                 lightbox.css('display', 'flex');
//                 lightboxImage.attr('src', otherPhoto);
//                 currentIndex = photos.indexOf(otherPhoto);
//                 console.log('Current photo index:', currentIndex);
//             });

//             if (nextPhoto.length) {
//                 nextPhoto.on('click', function () {
//                     currentIndex = (currentIndex + 1) % photos.length;
//                     lightboxImage.attr('src', photos[currentIndex]);
//                     console.log('Next photo index:', currentIndex);
//                 });
//             }

//             if (prevPhoto.length) {
//                 prevPhoto.on('click', function () {
//                     currentIndex = (currentIndex - 1 + photos.length) % photos.length;
//                     lightboxImage.attr('src', photos[currentIndex]);
//                     console.log('Previous photo index:', currentIndex);
//                 });
//             }

//             $('.close-lightbox').on('click', closeLightbox);

//             function closeLightbox() {
//                 lightbox.css('display', 'none');
//             }

//             $(window).on('click', function (event) {
//                 if ($(event.target).is('#myModal')) {
//                     $('#myModal').css('display', 'none');
//                 } else if ($(event.target).is(lightbox)) {
//                     closeLightbox();
//                 }
//             });
//         }

//         function initModal() {
//             const modal = $('#myModal');
//             const btn = $('#menu-item-9');
//             const btn2 = $('#singleContact');

//             function showModal() {
//                 modal.css('display', 'flex');
//             }

//             if (btn.length) btn.on('click', showModal);
//             if (btn2.length) btn2.on('click', showModal);
//         }

//         function initRedirection() {
//             $('.eyes').on('click', function () {
//                 const postUrl = $(this).data('url');
//                 window.location.href = postUrl;
//             });
//         }

//         function handleReferenceElement() {
//             const maReferenceElement = $('#maReference');
//             let maReference = '';

//             if (maReferenceElement.length) {
//                 maReference = maReferenceElement.text();
//                 console.log('Reference:', maReference);
//             }

//             $(document).ready(function () {
//                 $(".champs-ref").val(maReference);
//             });
//         }

//         function initSinglePhotoHoverEffects() {
//             const arrowRight = $(".arrow-right");
//             const arrowLeft = $(".arrow-left");
//             const photoNext = $(".photo-next");
//             const photoPrev = $(".photo-prev");
//             const arrowsAlone = $(".arrows");

//             if (arrowRight.length) {
//                 arrowRight.on('mouseover', function () {
//                     if (photoNext.length && arrowsAlone.length) {
//                         photoNext.addClass('active-img');
//                         arrowsAlone.removeClass('arrows-alone');
//                     }
//                 });

//                 arrowRight.on('mouseout', function () {
//                     if (photoNext.length && arrowsAlone.length) {
//                         photoNext.removeClass('active-img');
//                         arrowsAlone.addClass('arrows-alone');
//                     }
//                 });
//             }

//             if (arrowLeft.length) {
//                 arrowLeft.on('mouseover', function () {
//                     if (photoPrev.length && arrowsAlone.length) {
//                         photoPrev.addClass('active-img');
//                         arrowsAlone.removeClass('arrows-alone');
//                     }
//                 });

//                 arrowLeft.on('mouseout', function () {
//                     if (photoPrev.length && arrowsAlone.length) {
//                         photoPrev.removeClass('active-img');
//                         arrowsAlone.addClass('arrows-alone');
//                     }
//                 });
//             }
//         }

//         // Initialize functions
//         initLightbox();
//         initModal();
//         initRedirection();
//         handleReferenceElement();
//         initSinglePhotoHoverEffects();

//     });
// });







// document.addEventListener('DOMContentLoaded', function () {
//     jQuery(function ($) {

//         function initLightbox() {
//             const lightbox = $('#lightbox');
//             const lightboxImage = $('#lightbox-image');
//             const prevPhoto = $('.contain-left');
//             const nextPhoto = $('.contain-right');
//             let currentIndex = 0;
//             let photos = [];

//             $('.photo-block .other-photo').each(function () {
//                 photos.push($(this).attr('src'));
//             });

//             console.log('Photos array:', photos);

//             $('.show-photo').on('click', function () {
//                 const otherPhoto = $(this).closest('.photo-block').find('.other-photo').attr('src');
//                 lightbox.css('display', 'flex');
//                 lightboxImage.attr('src', otherPhoto);
//                 currentIndex = photos.indexOf(otherPhoto); // Update currentIndex when opening the lightbox
//                 console.log('Current photo index:', currentIndex);
//             });

//             if (nextPhoto.length) {
//                 nextPhoto.on('click', function () {
//                     currentIndex = (currentIndex + 1) % photos.length;
//                     lightboxImage.attr('src', photos[currentIndex]);
//                     console.log('Next photo index:', currentIndex);
//                 });
//             }

//             if (prevPhoto.length) {
//                 prevPhoto.on('click', function () {
//                     currentIndex = (currentIndex - 1 + photos.length) % photos.length;
//                     lightboxImage.attr('src', photos[currentIndex]);
//                     console.log('Previous photo index:', currentIndex);
//                 });
//             }

//             $('.close-lightbox').on('click', closeLightbox);

//             function closeLightbox() {
//                 lightbox.css('display', 'none');
//             }

//             $(window).on('click', function (event) {
//                 if ($(event.target).is('#myModal')) {
//                     $('#myModal').css('display', 'none');
//                 } else if ($(event.target).is(lightbox)) {
//                     closeLightbox();
//                 }
//             });
//         }

//         function initModal() {
//             const modal = $('#myModal');
//             const btn = $('#menu-item-9');
//             const btn2 = $('#singleContact');

//             function showModal() {
//                 modal.css('display', 'flex');
//             }

//             if (btn.length) btn.on('click', showModal);
//             if (btn2.length) btn2.on('click', showModal);
//         }

//         function initRedirection() {
//             $('.eyes').on('click', function () {
//                 const postUrl = $(this).data('url');
//                 window.location.href = postUrl;
//             });
//         }

//         function handleReferenceElement() {
//             const maReferenceElement = $('#maReference');
//             let maReference = '';

//             if (maReferenceElement.length) {
//                 maReference = maReferenceElement.text();
//                 console.log('Reference:', maReference);
//             } else {
//                 console.log('Element with id "maReference" not found');
//             }

//             $(document).ready(function () {
//                 $(".champs-ref").val(maReference);
//             });
//         }

//         function initSinglePhotoHoverEffects() {
//             const arrowRight = $(".arrow-right");
//             const arrowLeft = $(".arrow-left");
//             const photoNext = $(".photo-next");
//             const photoPrev = $(".photo-prev");
//             const arrowsAlone = $(".arrows");

//             if (arrowRight.length) {
//                 arrowRight.on('mouseover', function () {
//                     if (photoNext.length && arrowsAlone.length) {
//                         photoNext.addClass('active-img');
//                         arrowsAlone.removeClass('arrows-alone');
//                     }
//                 });

//                 arrowRight.on('mouseout', function () {
//                     if (photoNext.length && arrowsAlone.length) {
//                         photoNext.removeClass('active-img');
//                         arrowsAlone.addClass('arrows-alone');
//                     }
//                 });
//             }

//             if (arrowLeft.length) {
//                 arrowLeft.on('mouseover', function () {
//                     if (photoPrev.length && arrowsAlone.length) {
//                         photoPrev.addClass('active-img');
//                         arrowsAlone.removeClass('arrows-alone');
//                     }
//                 });

//                 arrowLeft.on('mouseout', function () {
//                     if (photoPrev.length && arrowsAlone.length) {
//                         photoPrev.removeClass('active-img');
//                         arrowsAlone.addClass('arrows-alone');
//                     }
//                 });
//             }
//         }

//         // Initialize functions
//         initLightbox();
//         initModal();
//         initRedirection();
//         handleReferenceElement();
//         initSinglePhotoHoverEffects();

//     });
// });