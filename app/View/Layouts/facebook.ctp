<?php echo $this->Facebook->html(); ?>
<head>
    <?php echo $this->html->css('cake.generic'); ?>
</head>
<body>
    <!-- content -->
    <div id="content" >
        <?php echo $content_for_layout; ?>
    </div>
    <!-- end content -->
</body>
<?php echo $this->Facebook->init(); ?> 
</html>
