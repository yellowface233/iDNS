<br /><br /><br />

<footer>
    <center>
        <small>Copyright &copy; i45S.COM 2024.03</small>
    </center>
</footer>

<script src="/js/canvas.js"></script>
<canvas height="926" width="1920" style="position: fixed; top: 0px; left: 0px; z-index: -1; opacity: 0.5;"
    id="c_n1"></canvas>
<script src="https://unpkg.zhimg.com/mdui@1.0.2/dist/js/mdui.min.js"></script>
</body>

</html>

<script src="https://jsd.onmicrosoft.cn/npm/pjax/pjax.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    let pjax = new Pjax({
        selectors: ['#_pjax_update_2', 'title', '#_pjax_update_1'],
        history: true,
        pushState: true,
        scrollRestoration: true,
        cacheBust: false
    });

    $(document).on("pjax:complete", function (event, xhr, options) {
        console.log('pjax:complete!');
        mdui.mutation();
    });


    window.__VUE__ = 1;
    window.__NUXT__ = 1;
</script>