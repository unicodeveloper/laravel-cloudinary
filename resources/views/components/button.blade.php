<script type="text/javascript">

    var cloudName = @json(config('cloudinary.account_details.account.cloud_name'));
    var uploadPreset = @json(config('cloudinary.account_details.account.upload_preset'));

    function openWidget() {
        window.cloudinary.openUploadWidget(
            { cloud_name: cloudName,
              upload_preset: uploadPreset
            },
            (error, result) => {
              if (!error && result && result.event === "success") {
                console.log('Done uploading..: ', result.info);
                document.getElementById("showImg").src = result.info.url;
              }
        }).open();
    }
</script>

<div>
    <img src="" id="showImg" width="350" height="350" />
</div>

<button type="button" onclick="openWidget()">
  {{ $slot }}
</button>


