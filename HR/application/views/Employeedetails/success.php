<script>
swal("<?php echo $msg; ?>", {
  buttons: {
    ok: "Ok",
    
  },
})
.then((value) => {
  window.location = "<?php echo $link; ?>";
});
</script>