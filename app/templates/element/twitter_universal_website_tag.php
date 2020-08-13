<?php
use Cake\Core\Configure;
?>

<?php if (!empty(Configure::read('Twitter.embedTag.universalWebsiteTagId'))): ?>
<!-- Twitter universal website tag code -->
<script>
!function (s, u, a) {
  window.twq || (
      s = window.twq = function () {
        s.exe ? s.exe.apply(s, arguments) : s.queue.push(arguments);
      },
      s.version = "1.1",
      s.queue = [],
      u = document.createElement("script"),
      u.async = !0,
      u.src = "//static.ads-twitter.com/uwt.js",
      a = document.getElementsByTagName("script")[0],
      a.parentNode.insertBefore(u, a)
  );
}();
// Insert Twitter Pixel ID and Standard Event data below
twq("init", "<?= Configure::read('Twitter.embedTag.universalWebsiteTagId') ?>");
twq("track", "PageView");
</script>
<!-- End Twitter universal website tag code -->
<?php endif; ?>

