<script>
swal("<?php echo $msg; ?>", {
  buttons: {
    ok: "Login",
    
  },
})
.then((value) => {
  window.location = "<?php echo $link; ?>";
});
</script>