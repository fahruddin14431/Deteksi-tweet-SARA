<!-- Vertical Layout | With Floating Label -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h3 class="col-deep-orange">
                    <b>TEST TWEET</b>
                </h3>            
            </div>
            <div class="body">
                <form action="Test_tweet/proses_cek_tweet.php" method="POST">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" name="tweet" class="form-control" required>
                            <label class="form-label">Masukan Tweet . . . </label>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-lg waves-effect">
                        <b>PROSES</b>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Vertical Layout | With Floating Label