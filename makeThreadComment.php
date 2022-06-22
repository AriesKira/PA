<div id="makeThreadCommentBody" class="shadow">
    <div class="container text-center">
        <div class="row text-center pt-4">
            <div class="col"></div>
            <div class="col-8">
                <h3 class="formTitles">Ton Commentaire</h3>
            </div>
            <div class="col"></div>
        </div>
        <form id="userThreadComment" method="POST" action="./addThreadComment.php?current=<?php echo $current ?>" enctype="multipart/form-data" class="pt-2">
            <div class="row pt-3">
                <h5 class="formTitles">Commentaire</h5>
                <div class="col"></div>
                <div class="col-10">
                    <div class="row" style="height: 100px;">
                        <textarea form="userThreadComment" name="userComment" placeholder="..." style="border-radius: 20px;"></textarea>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="row pt-2">
                <div class="col"></div>
                <div class="col-8">
                    <h5 class="formTitles">illustre ton commentaire</h5>
                    <div class="row">
                        <input type="file" name="commentImage" accept="image/png, image/gif, image/jpeg" class="form-control text-center">
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