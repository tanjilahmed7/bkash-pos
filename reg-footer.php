            <div class="footer">
                <img src="image/footer.jpg" alt="" />
            </div>
        </div>  
        <!-- // container -->



        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script>
            
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2({
                    placeholder: "Choose here",
                    allowClear: true
                });
            });
            $(document).ready(function(){
            $('.slectOne').on('change', function() {
               $('.slectOne').not(this).prop('checked', false);
               $('#result').html($(this).data( "id" ));
               if($(this).is(":checked"))
                $('#result').html($(this).data( "id" ));
               else
                $('#result').html('Empty...!');
            });
            });  
        </script>
        <script src="js/select2.min.js"></script>
    </body>
</html>