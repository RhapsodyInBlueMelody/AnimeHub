<div id="loading-spinner" style="display: flex; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: white; z-index: 9999;">
  <div class="spinner-border text-primary" role="status">
  </div>
</div>

<div id="content" style="display: none;">
<div class="container-fluid px-5">
    <div class="row">
        <div class="col-12">
            <?php Flasher::flash() ?>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-12 col-md-6">
            <button type="button" class="btn btn-primary mb-4 addModal" data-bs-toggle="modal" data-bs-target="#formModal">
                Add Anime to the Watchlist
            </button>
            <h3>Anime Watchlist</h3>
            <div class="container-fluid px-0">
                <ul class="list-group list-group-flush" id="animeList">
                    <?php foreach ($data['Animelist'] as $anime): ?>
                        <li class="list-group-item d-flex align-items-center p-3" data-anime-name="<?= $anime['animeName'] ?>">
                            <figure class="figure mb-0 me-3 flex-shrink-0">
                                <img src="" class="figure-img rounded anime-image" width="130" height="200" alt="<?= $anime['animeName']; ?>">
                            </figure>
                            <span class="anime-title fw-bold flex-grow-1 fs-2"><?= $anime['animeName'] ?></span>
                            <div class="ms-3 d-flex flex-wrap">
                                <a href="<?= BASEURL ?>/Animelist/detail/<?= $anime['id'] ?>" class="badge text-bg-primary rounded-3 text-decoration-none px-3 py-2 mx-1">Detail</a>
                                <a href="#" class="badge text-bg-success rounded-3 text-decoration-none updateModal px-3 py-2 mx-1" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $anime['id']?>">Update</a>
                                <a href="javascript:void(0);" class="badge text-bg-danger delete rounded-3 text-decoration-none px-3 py-2 mx-1" data-id="<?= $anime['id']?>">Delete</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Add Anime Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="animeForm" action="<?= BASEURL; ?>/Animelist/add" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Title</label>
                        <input type="text" class="form-control" name="animeName" id="name"  placeholder="max 200 characters" maxlength="200" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Published Date</label>
                        <input type="date" class="form-control" name="publishedDate" id="date"  required>
                    </div>
                    <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                        <select class="form-select" name="animeGenre" id="genre" required>
                            <option value="Shonen">Shonen</option>
                            <option value="Shoujo">Shoujo</option>
                            <option value="Josei">Josei</option>
                            <option value="Seinen">Seinen</option>
                            <option value="Kodomomuke">Kodomomuke</option>
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Echi">Echi</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Slice Of Life">Slice Of Life</option>
                            <!-- Add more genres here -->
                        </select>
                    </div>
                    <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                        <select class="form-select" name="animeRating" id="rating" required>
                            <option value="G">G</option>
                            <option value="PG">PG</option>
                            <option value="PG-13">PG-13</option>
                            <option value="R">R</option>
                            <option value="NC-17">NC-17</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="studio" class="form-label">Studio</label>
                        <input type="text" class="form-control" name="animeStudio" id="studio" placeholder="max 50 characters" maxlength="50" >
                    </div>
                    <div class="mb-3">
                        <label for="sinopsis" class="form-label">Sinopsis</label>
                        <textarea class="form-control" name="animeSinopsis" id="sinopsis" rows="3" placeholder="max 255 characters" maxlength="255"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Have you watched it?</label>
                        <div>
                            <input class="form-check-input" type="radio" name="animeWatched" id="notYet" value="0" required>
                            <label class="form-check-label" for="notYet">Not Yet</label>
                            <input class="form-check-input" type="radio" name="animeWatched" id="watched" value="1" required>
                            <label class="form-check-label" for="watched">Watched</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Anime</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
    