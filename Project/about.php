<?php
    require 'partials/db.php';
    session_start();
    
    $active_page = "about";
?>

<!DOCTYPE html>
    <head>
        <title>About</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css"/>
        
        <!-- Prism syntax highlighter CSS -->
        <link rel="stylesheet" href="../../node_modules/prismjs/themes/prism-okaidia.css"/>
        
        <!-- Font Awesome (CDN) -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Miriam+Libre|Source+Sans+Pro:700|Open+Sans:300" rel="stylesheet">
        
        <!-- Style -->
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
        <div class="spacer-lg_btm"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                   <?php include 'partials/navigation.php'; ?>
                </div>
                
                <div class="col-md-9">
                    <span class="font-md_grey source_sans_pro">ABOUT</span>
                    <h3 class="font-white miriam_libre">About Us</h3>
                    <div class="divider-btm"></div>
                    
                    <!-- Spacer -->
                    <div class="spacer-sm_btm"></div>
                    
                    <!-- Section 1 -->
                    <h1 class="font-white source_sans_pro text-center">The Ecosystem.</h1>
                    <h5 class="font-md_grey miriam_libre text-center">Ensure the best, use the best.</h5>
                    
                    <!-- Spacer -->
                    <div class="spacer-sm_btm"></div>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4" style="position: relative;">
                                <div class="info-box">
                                    <div class="info-bar">
                                        <h4 class="font-white miriam_libre">Contribute</h4>
                                        <span class="fa fa-cloud-upload font-white"></span>
                                    </div>
                                    <div class="info-content">
                                        <p class="font-white">Contribute code solutions in a variety of supported languages for others to see, rate, and use.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4" style="position: relative;">
                                <div class="info-box second">
                                    <div class="info-bar">
                                        <h4 class="font-white miriam_libre">Curate</h4>
                                        <span class="fa fa-star-half-o font-white"></span>
                                    </div>
                                    <div class="info-content">
                                        <p class="font-white">Rate the usefullness of others submissions, contributing to the overall curation of content and ensuring quality.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4" style="position: relative;">
                                <div class="info-box third">
                                    <div class="info-bar">
                                        <h4 class="font-white miriam_libre">Implement</h4>
                                        <span class="fa fa-code-fork font-white"></span>
                                    </div>
                                    <div class="info-content">
                                        <p class="font-white text-justify">Implement any of the code solutions submitted by others within your own projects.</p>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div>
                    
                    <!-- Spacer -->
                    <div class="spacer-md_btm"></div>
                    
                    <!-- Section 2 -->
                    <h1 class="font-white source_sans_pro text-center">Code for you, by you.</h1>
                    <h5 class="font-md_grey miriam_libre text-center">Elegant, expressive, beautiful code.</h5>
                    
                    <!-- Spacer -->
                    <div class="spacer-sm_btm"></div>
                    
                    <div class="container" id="about_blackbox">
                        <!-- Console window -->
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="font-neon_blue source_sans_pro">Elegant</h4>
                                <p class="font-white text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div class="col-md-6" style="position: relative;">
                                <div class="console-window">
                                    <div class="top-bar">
                                        <span class="fa fa-circle font-white first"></span>
                                        <span class="fa fa-circle font-white second"></span>
                                        <span class="fa fa-circle font-white third"></span>
                                    </div>
                                    <div class="console-numbers font-sm_grey"></div>
                                    <div class="console-content">
                                        <pre><code class="language-markup">
                                            <?php $str="<html>
                                                <head>
                                                    <title>HTML</title>
                                                </head>
                                                <body>
                                                    <h1 class='welcome'>Welcome to HTML!</h1>
                                                </body>
                                            </html>";
                                                echo htmlspecialchars($str);
                                        ?></code></pre>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        
                        <!-- Spacer and line divider -->
                        <div class="spacer-sm_btm"></div>
                        <div class="divider-btm"></div>
                        <div class="spacer-sm_btm"></div>
                        
                        <!-- Console window -->
                        <div class="row">
                            <div class="col-md-6" style="position: relative;">
                                <div class="console-window">
                                    <div class="top-bar">
                                        <span class="fa fa-circle font-white first"></span>
                                        <span class="fa fa-circle font-white second"></span>
                                        <span class="fa fa-circle font-white third"></span>
                                    </div>
                                    <div class="console-numbers font-sm_grey"></div>
                                    <div class="console-content">
                                        <pre><code class="language-php">
                                            <?php 
                                                $str = '<?php
                                                /* This is how the snippets are displayed! */
                                                $str = "<?php 
                                                            echo "$str = The Snippet!"; 
                                                        ?>"
                                                /* This replaces special characters, like <> */
                                                echo htmlspecialchars($str);
                                            ?>';
                                                
                                                echo htmlspecialchars($str);
                                            ?>
                                        </code></pre>    
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-md-6">
                                <h4 class="font-neon_blue source_sans_pro">Expressive</h4>
                                <p class="font-white text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                        </div>
                        
                        <!-- Spacer and line divider -->
                        <div class="spacer-sm_btm"></div>
                        <div class="divider-btm"></div>
                        <div class="spacer-sm_btm"></div>
                        
                        <!-- Console window -->
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="font-neon_blue source_sans_pro">Beautiful</h4>
                                <p class="font-white text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div class="col-md-6" style="position: relative;">
                                <div class="console-window">
                                    <div class="top-bar">
                                        <span class="fa fa-circle font-white first"></span>
                                        <span class="fa fa-circle font-white second"></span>
                                        <span class="fa fa-circle font-white third"></span>
                                    </div>
                                    <div class="console-numbers font-sm_grey"></div>
                                    <div class="console-content" style="overflow: auto;">
                                        <pre><code class="language-css">
                                            <?php $str="/*This is the CSS for these console boxes!*/
                                            .console-window{
                                                width: 100%;
                                                height: 200px;
                                                border-radius: 5px;
                                                background-color: #2A2C2B;    
                                            }
                                            
                                            .top-bar{
                                                width: 100%;
                                                height: 20%;
                                                border-radius: 5px 5px 0 0;
                                                background-color: #374140;
                                            }
                                            
                                            .console-numbers {
                                                width: 10%;
                                                height: 80%;
                                                float: left;
                                                line-height: 80%;
                                                font-size: 12px;
                                                text-align: right;
                                                padding: 5px 5px 0 0;
                                                border-radius: 0 0 0 5px;
                                                background-color: #2F3837;
                                            }
                                            
                                            .console-content {
                                                width: 90%;
                                                height: 80%;
                                                float: left;
                                                font-size: 12px;
                                            }";
                                                echo htmlspecialchars($str);
                                        ?></code></pre>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Spacer -->
                    <div class="spacer-lg_btm"></div>
                    
                    <!-- Section 3 -->
                    <div class="container-fluid text-center">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="divider-btm"></div>
                            </div>
                            
                            <div class="col-md-2">
                                <h5 class="font-neon_blue source_sans_pro" style="line-height: 0%;">AND MORE</h5>
                            </div>
                            
                            <div class="col-md-5">
                                <div class="divider-btm"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Spacer -->
                    <div class="spacer-sm_btm"></div>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4" style="border-right: 2px solid rgba(77,84,100,.5);">
                                <h5 class="font-white miriam_libre"><span class="fa fa-code font-white" style="font-size: 25px;"></span> Syntax</h5>
                                <p class="font-white">Using PrismJS, it's never been easier to display code how it was meant to be seen, and this goes for your submissions too.</p>
                                
                                <!-- Spacer -->
                                <div class="spacer-sm_btm"></div>
                                
                                <h5 class="font-white miriam_libre"><span class="fa fa-code font-white" style="font-size: 25px;"></span> Basic Markup</h5>
                                <p class="font-white">Forgotten something? It happens. We provide not only the complex and sublime, but also the most basic examples to get you started.</p>
                            </div>
                            
                            <div class="col-md-4" style="border-right: 2px solid rgba(77,84,100,.5);">
                                <h5 class="font-white miriam_libre"><span class="fa fa-tags font-white" style="font-size: 25px;"></span> Tag</h5>
                                <p class="font-white">Submitting HTML? CSS? PHP? Tagging allows you to inform everyone just what language your code pertains to.</p>
                                
                                <!-- Spacer -->
                                <div class="spacer-sm_btm"></div>
                                
                                <h5 class="font-white miriam_libre"><span class="fa fa-filter font-white" style="font-size: 25px;"></span> Filter</h5>
                                <p class="font-white">Whether looking for something specific by name, or by tag, our search allows you to filter content quickly and efficiently to find just what you need.</p>
                            </div>
                            
                            <div class="col-md-4">
                                <h5 class="font-white miriam_libre"><span class="fa fa-thumbs-up font-white" style="font-size: 25px;"></span> Status</h5>
                                <p class="font-white">Build your reputation within the community by submitting quality content. Positive ratings are attributed to you.</p>
                                
                                <!-- Spacer -->
                                <div class="spacer-sm_btm"></div>
                                
                                <h5 class="font-white miriam_libre"><span class="fa fa-eraser font-white" style="font-size: 25px;"></span> Edit and Delete</h5>
                                <p class="font-white">Made a mistake? Has something been deprecated? No problem. You can edit or delete any of your submissions at any time, for any reason.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Spacer -->
                    <div class="spacer-lg_btm"></div>
                </div>
            </div>
        </div>
        <!-- Prism syntax highlighter JS -->
        <script src="../../node_modules/prismjs/prism.js"></script>
        <script src="../../node_modules/prismjs/components/prism-php.js"></script>
        <script src="../../node_modules/prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.js"></script>
    </body>
</html>