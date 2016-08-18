<div class="mysmallfont">
    <?php include 'templates/initializedb.php'; ?>
    <div class="container">
        <div>
            <h1 class="text-center"><span class="glyphicon glyphicon-usd"></span> Input Data Dropping</h1>
            <p class="text-center">PT. Bukit Asam (Persero) Tbk CSR Program</p>
            <p class="text-center"><img src="asset/separator.png" width="200" alt=""/></p>
            <div class="form-horizontal">
                <form id="foo">
                    <div class="form-group">
                        <label class='control-label col-sm-4' for="tgl">Tanggal Masuk :</label>
                        <div class="col-sm-5">   
                            <input required name="tgl" type="text" class="form-control my-no-hover" id="tgl" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class='control-label col-sm-4' for="jml">Jumlah :</label>
                        <div class="col-sm-1" style="padding-left:0px !important; margin: 0px !important">
                            <h2 class="text-right" style="margin: 0px">Rp.</h2>
                        </div>
                        <div class="col-sm-4" style="padding-left: 0px !important;">   
                            <input required name='jml' type="text" class="form-control my-no-hover" id="jml" />
                        </div>
                    </div>

                    <p class="text-center"><img src="asset/separator.png" width="200" alt=""/></p>
                    <br/><br/>
                    <div class="col-sm-6 center-col">
                        <button id='submit' class='btn btn-lg btn-block btn-primary'><span class="glyphicon glyphicon-check"></span> Selesai</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    var request;
    $("#submit").click(function (event) {

        if (request) {
            request.abort();
        }
        var $form = $("#foo");
        var $inputs = $form.find("input, select, button, textarea");
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);
        request = $.ajax({
            url: "core/core-dropping.php",
            type: "post",
            data: serializedData
        });
        request.done(function (response, textStatus, jqXHR) {
            window.location.replace('home.php');
        });
        request.fail(function (jqXHR, textStatus, errorThrown) {
            alert(
                    "The following error occurred: " +
                    textStatus, errorThrown
                    );
        });
        request.always(function () {
            $inputs.prop("disabled", false);
        });
        event.preventDefault();

    });
</script>