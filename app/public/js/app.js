$(document).ready(function() {
    $('.addModal').on('click', function() {
        $('#judulModal').html('Add Anime Watchlist')
        $('.modal-footer button[type=submit]').html('Add Data')
        $('#id').val("")
        $('#name').val("")
        $('#genre').val("")
        $('#date').val("")
        $('#rating').val("")
        $('#sinopsis').val("")
        $('#notYet').prop('checked', false);
        $('#watched').prop('checked', false);
    });
    

    $('.updateModal').on('click', function() {
        $('#judulModal').html('Update Anime Watchlist')
        $('.modal-footer button[type=submit]').html('Update Data')
        $('.modal-body form').attr('action', 'http://localhost/Animelist/update')
        const userId = $(this).data('id');
        $.ajax({
            url: '/Animelist/getUpdate/',
            data: {id : userId},
            method: 'POST',
            dataType: 'json',
            success: function(response) {
                $('#id').val(response.id)
                $('#name').val(response.animeName)
                $('#genre').val(response.animeGenre)
                $('#date').val(response.publishedDate)
                $('#rating').val(response.animeRating)
                $('#studio').val(response.animeStudio)
                $('#sinopsis').val(response.animeSinopsis)
                  if (response.animeWatched == 1) {
                $('#watched').prop('checked', true); // Select "Watched"
            } else {
                $('#notYet').prop('checked', true); // Select "Not Yet"
            }
         }
        })
    });


    $('.delete').on('click', function(e) {
        e.preventDefault();

        const userId = $(this).data('id');
        const rowToDelete = $(this).closest('li')

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/Animelist/delete/' + userId,
                    type: 'POST',
                    success: function(respose) {
                        Swal.fire(
                            'Deleted!',
                            'The user has been deleted.',
                            'success'
                        );
                        rowToDelete.remove();
                        
                    },
                    error: function(xhr, status, error) {
                        // Handle errors gracefully
                        Swal.fire(
                            'Error!',
                            'There was an issue deleting the user.',
                            'error',
                        )
                    },
                })
                
            }
        });
    });

    const MAX_CONCURRENT_REQUESTS = 3; // Adjust this based on the API's rate limit
    const DELAY_BETWEEN_REQUESTS = 3000; // Delay in milliseconds
    function fetchImage(animeName, imgElement) {
        return new Promise((resolve) => {
            $.ajax({
                url: `https://api.jikan.moe/v4/anime?q=${encodeURIComponent(animeName)}&limit=1`,
                method: 'GET',
                success: function(response) {
                    if (response.data && response.data.length > 0) {
                        const imageUrl = response.data[0].images.jpg.image_url;
                        imgElement.attr('src', imageUrl);
                    } else {
                        imgElement.attr('src', 'https://placehold.co/130x200'); // Fallback image
                    }
                    resolve();

                },
    
                error: function(jqXHR, textStatus, errorThrown) {
    
                    console.error(`Error fetching image for ${animeName}: ${textStatus}`, errorThrown);
    
                    imgElement.attr('src', 'https://placehold.co/130x200'); // Error fallback image
    
                    resolve();
    
                }
    
            });
    
        });
    
    }
    
    
    async function loadImages() {
    
        const imagePromises = [];
    
        $('#animeList li').each(function() {
    
            const animeName = $(this).data('anime-name');
    
            const imgElement = $(this).find('.anime-image');
    
            imagePromises.push({ animeName, imgElement });
    
        });
    
    
        for (let i = 0; i < imagePromises.length; i += MAX_CONCURRENT_REQUESTS) {
    
            const currentBatch = imagePromises.slice(i, i + MAX_CONCURRENT_REQUESTS);
    
            const fetchPromises = currentBatch.map(({ animeName, imgElement }) => fetchImage(animeName, imgElement));
    
    
            await Promise.all(fetchPromises); // Wait for all images in the current batch to load
    
            await new Promise(resolve => setTimeout(resolve, DELAY_BETWEEN_REQUESTS)); // Delay before next batch
    
        }
    
    
        // Hide the loading spinner
    
        $('#loading-spinner').hide();
    
        // Show the content
    
        $('#content').show();
    
    }
    
    
    loadImages();;

    $('.animecarousel').each(function(index, imgElement) {
        // Fetch image from API
        $.ajax({
            url: `https://api.nekosapi.com/v3/images/random?rating=safe`,
            method: 'GET',
            success: function(response) {
                if (response.items && response.items.length > 0) {
                    const imageUrl = response.items[0].image_url;
                    $(imgElement).attr('src', imageUrl);
                } else {
                    $(imgElement).attr('src', 'https://placehold.co/300x200'); // Fallback image
                }
            },
            error: function() {
                $(imgElement).attr('src', 'https://placehold.co/300x200'); // Error fallback image
            }
        });
    });

    
});