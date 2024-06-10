document.addEventListener('DOMContentLoaded', function () {
    jQuery(function ($) {

        let photos = [];

        // Define the function globally
        window.initLightbox = function() {
            const lightbox = $('#lightbox');
            const lightboxImage = $('#lightbox-image');
            const refPhoto = $('.hover-ref');
            const catPhoto = $('.hover-cat');
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
                    const reference = $(this).data('reference');
                    const categorie = $(this).data('categorie');
                    
                    lightbox.css('display', 'flex');
                    lightboxImage.attr('src', otherPhoto);
                    refPhoto.text(reference);
                    catPhoto.text(categorie);

                    currentIndex = photos.indexOf(otherPhoto);
                    console.log('Current photo index:', currentIndex);
                });

                if (nextPhoto.length) {
                    nextPhoto.off('click').on('click', function () {
                        currentIndex = (currentIndex + 1) % photos.length;
                        lightboxImage.attr('src', photos[currentIndex]);
                        // Update reference and category when navigating
                        const currentBlock = $('.photo-block-wrapper .other-photo').eq(currentIndex).closest('.photo-block');
                        refPhoto.text(currentBlock.find('.show-photo').data('reference'));
                        catPhoto.text(currentBlock.find('.show-photo').data('categorie'));
                        console.log('Next photo index:', currentIndex);
                    });
                }

                if (prevPhoto.length) {
                    prevPhoto.off('click').on('click', function () {
                        currentIndex = (currentIndex - 1 + photos.length) % photos.length;
                        lightboxImage.attr('src', photos[currentIndex]);
                        // Update reference and category when navigating
                        const currentBlock = $('.photo-block-wrapper .other-photo').eq(currentIndex).closest('.photo-block');
                        refPhoto.text(currentBlock.find('.show-photo').data('reference'));
                        catPhoto.text(currentBlock.find('.show-photo').data('categorie'));
                        console.log('Previous photo index:', currentIndex);
                    });
                }

                $('.close-lightbox').off('click').on('click', closeLightbox);

                $(window).on('click', function (event) {
                    if ($(event.target).is('#myModal')) {
                        $('#myModal').css('display', 'none');
                    } else if ($(event.target).is(lightbox)) {
                        closeLightbox();
                    }
                });
            }

            function closeLightbox() {
                lightbox.css('display', 'none');
                bodyAll.removeClass("no-scroll")
            }

            collectPhotos();
            attachEvents();
        };

        function initModal() {
            const modal = $('#myModal');
            const btn = $('#menu-item-9');
            const btn2 = $('#singleContact');

            function showModal() {
                modal.css('display', 'flex');
                bodyAll.addClass("no-scroll")
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

        function initRedirectionMobile() {
            if ($(window).width() < 768) {
                $('.photo-block').on('click', function () {
                    const postUrl = $(this).find('.eyes').data('url');
                    window.location.href = postUrl;
                });
            } else {
                $('.photo-block').off('click');
            }
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

        // Hover Photo

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
                console.log('Load more button clicked');
                loadPhotos();
            });
        }

        // Initialize functions
        initLightbox();
        initModal();
        initRedirection();
        initRedirectionMobile()
        handleReferenceElement();
        initSinglePhotoHoverEffects();
        initLoadMore();


        // Select2
        $(document).ready(function() {
            $('.filter-select').select2({
                minimumResultsForSearch: -1
            }).on('select2:open', function() {
                // Ajouter la classe pour faire pivoter la flèche
                $(this).next('.select2-container').find('.select2-selection--single').addClass('select2-arrow-rotated');
            }).on('select2:close', function() {
                // Retirer la classe pour remettre la flèche dans sa direction d'origine
                $(this).next('.select2-container').find('.select2-selection--single').removeClass('select2-arrow-rotated');
            });
        });


        // Burger menu
        let siteNav = $(".header-menu");
        let openBtn = $("#openBtn");
        let closeBtn = $("#closeBtn");
        let contactMenu = $("#menu-item-9")
        let bodyAll = $(".body-all")

        openBtn.on('click', openNav);
        closeBtn.on('click', closeNav);
        contactMenu.on('click', closeNav);

        function openNav() {
            siteNav.addClass("active-menu").removeClass("no-active-menu");
            closeBtn.addClass("open-close");
            openBtn.addClass("close-open").removeClass("open-open");
            bodyAll.addClass("no-scroll")
        }

        function closeNav() {
            siteNav.removeClass("active-menu").addClass("no-active-menu");
            closeBtn.removeClass("open-close");
            openBtn.removeClass("close-open").addClass("open-open");
            bodyAll.removeClass("no-scroll")
        }
    });
});