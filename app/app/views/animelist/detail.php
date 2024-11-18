<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="card" style="width: 50rem;">
    <div class="card-body">
      <h5 class="card-title fs-1"><?= $data['Animelist']['animeName'] ?></h5>
      <label for="date">Published Date:</label>
      <h6 class="card-subtitle mb-3 fs-2 text-body-secondary"><?= $data['Animelist']['publishedDate'] ?></h6>
      <label for="genre">Genre:</label>
      <h6 class="card-subtitle mb-3 fs-2 text-body-secondary"><?= $data['Animelist']['animeGenre'] ?></h6>
      <label for="rating">Rating:</label>
      <h6 class="card-subtitle mb-3 fs-2 text-body-secondary"><?= $data['Animelist']['animeRating'] ?></h6>
      <label for="studio">Studio:</label>
      <h6 class="card-subtitle mb-3 fs-2 text-body-secondary"><?= $data['Animelist']['animeStudio'] ?></h6>
      <label for="wathced">Watched :</label>
      <h6 class="card-subtitle mb-3 fs-2 text-body-secondary"><?= $data['Animelist']['animeWatched']  == 1 ? 'Watched' : 'Not Yet' ?></h6>
      <label for="studio">Sinopsis</label>
      <p class="card-text"><?= $data['Animelist']['animeSinopsis']?></p>
      <a href="<?= BASEURL ?>/Animelist" class="rounded-pill bg-text-primary card-link">Back</a>
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
                        <input type="text" class="form-control" name="name" id="name"  placeholder="max 200 characters" maxlength="200" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Published Date</label>
                        <input type="date" class="form-control" name="date" id="date"  required>
                    </div>
                    <div class="mb-3">
                    <label for="date" class="form-label">Genre</label>
                        <select class="form-select" name="genre" id="genre" required>
                            <option value="1">Shonen</option>
                            <option value="2">Shoujo</option>
                            <option value="3">Josei</option>
                            <option value="4">Seinen</option>
                            <option value="5">Kodomomuke</option>
                            <option value="6">Action</option>
                            <option value="7">Adventure</option>
                            <option value="8">Echi</option>
                            <option value="9">Comedy</option>
                            <option value="10">Slice Of Life</option>
                            <!-- Add more genres here -->
                        </select>
                    </div>
                    <div class="mb-3">
                    <label for="date" class="form-label">Rating</label>
                        <select class="form-select" name="rating" id="rating" required>
                            <option value="1">G</option>
                            <option value="2">PG</option>
                            <option value="3">PG-13</option>
                            <option value="4">R</option>
                            <option value="5">NC-17</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="studio" class="form-label">Studio</label>
                        <input type="text" class="form-control" name="studio" id="studio" placeholder="max 50 characters" maxlength="50" required>
                    </div>
                    <div class="mb-3">
                        <label for="sinopsis" class="form-label">Sinopsis</label>
                        <textarea class="form-control" name="sinopsis" id="sinopsis" rows="3" placeholder="max 255 characters" maxlength="255" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Have you watched it?</label>
                        <div>
                            <input class="form-check-input" type="radio" name="watched" id="notYet" value="Not Yet" required>
                            <label class="form-check-label" for="notYet">Not Yet</label>
                            <input class="form-check-input" type="radio" name="watched" id="watched" value="Watched" required>
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