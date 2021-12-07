
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>URL Shortener</title>
        <style>
            h3{
                color:#851a31
            }  
            h3 span{
                color:#981e38

            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div  class="col-md-6  ">
                    <div id="wrapper" class="pt-5">
                        <div id="content_short">
                            <div id="header_short" class="pb-2">
                                <h3>URL <span class="">  Shortener</span></h3>
                            </div>
                            <form method="post" action="short.php" name="shortForm" id="shortForm">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="url_short" id="url_short" required="" placeholder="Enter the long url">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" value="submit"  id="submit_short" >SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="content_redirect" class="pt-5">
                            <div id="header_redirect" class="pb-2">
                                <h3>  URL <span class="">Redirect</span></h3>
                            </div>

                            <form method="post" action="redirect.php" name="redirectForm" id="redirectForm">

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="url_redirect" id="url_redirect" required placeholder="Enter the short url">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" value="submit"  id="submit_redirect" >SUBMIT</button>
                                    </div>
                                </div>


                            </form>



                        </div>
                    </div>	
                </div>
            </div>
        </div>
        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




    </body>
</html>
