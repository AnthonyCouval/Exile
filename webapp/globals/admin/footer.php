</footer>
<!-- footer end -->

<!-- JAVASCRIPT -->
<?php
\Lib\Loader::loadJS();
if(\Core\Exile::$ENVAR['action'] === 'admin') {
    \Lib\Loader::loadJS(false, true);
}
?>

</body>
</html>