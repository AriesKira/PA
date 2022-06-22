<div id="makeThreadBody" class="shadow">
    <div class="container text-center">
        <div class="row text-center pt-4">
            <div class="col"></div>
            <div class="col-8">
                <h3 class="formTitles">CRÉE TON THREAD !</h3>
            </div>
            <div class="col"></div>
        </div>
        <form id="userThread" method="POST" action="./addThread.php" enctype="multipart/form-data" class="pt-4">
            <div class="row">
                <div class="col-2"></div>
                <div class="col">
                    <h5 class="formTitles">Titre</h5>
                    <div class="row">
                        <input type="text" class="form-control" name="threadTitle" required="required" placeholder="Titre du Thread (255 caractères MAX)">
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row pt-2">
                <div class="col-2"></div>
                <div class="col">
                    <h5 class="formTitles">Theme</h5>
                    <div class="row">
                    <select name="threadTheme" required="required" class="form-control">
                        <option value="Developpement">Developpement</option>
                        <option value="Sécurité">Sécurité</option>
                        <option value="Réseau">Réseau</option>
                        <option value="autre">autre</option>
				    </select>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row pt-4">
                <div class="col"></div>
                <div class="col-8">
                    <h5 class="formTitles">Upload ton image !</h5>
                    <div class="row">
                        <input type="file" name="threadImg" accept="image/png, image/gif, image/jpeg" class="form-control text-center">
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="row pt-3">
                <h5 class="formTitles">Description</h5>
                <div class="col"></div>
                <div class="col-10">
                    <div class="row" style="height: 100px;">
                        <textarea form="userThread" name="threadDescription" placeholder="Description..." style="border-radius: 20px;"></textarea>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="row">
            <div class="col"></div>
                <div class="col">
                    <input type="submit" class="btn btn-outline-danger mt-4" value="Crée">
                </div>
            <div class="col"></div>
            </div>
        </form>
    </div>
</div>