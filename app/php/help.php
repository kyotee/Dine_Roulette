<?php

        session_start();
        if ($_SESSION['userID'] != 1)
        {
                
                echo <<<_MSG
                <script>
                    document.location.href = '/DineRoulette-tamkylet/index.php';
                </script>
_MSG;
        }
        else
        {}
        
    include ("/home/ubuntu/workspace/DineRoulette-tamkylet/app/html/skeletontop.html");
    
    
    echo <<<_END
    
       <body>
       
            <div id="inbordermidhelp">
            
            <div id="inbordermidhelpPAD">
                <br/>
                <p class="titles">Here is how it works</p>
                <blockquote><img src='/DineRoulette-tamkylet/app/images/gastown.png' style='width:25%;height:30%' alt='[]' /></blockquote>
                
                <blockquote>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
                         et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                         dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui 
                         officia deserunt mollit anim id est laborum.
                </blockquote>
                
                
               <br/>
                <p class="titles">How to use service</p>
                <blockquote><img src='/DineRoulette-tamkylet/app/images/gastown.png' style='width:25%;height:30%' alt='[]' /></blockquote>
                
                <blockquote>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
                         et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                         dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui 
                         officia deserunt mollit anim id est laborum.
                </blockquote>
                
                
               <br/>
                <p class="titles">Suggestions to users</p>
                <blockquote><img src='/DineRoulette-tamkylet/app/images/gastown.png' style='width:25%;height:30%' alt='[]' /></blockquote>
                
                <blockquote>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
                         et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut 
                         aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                         dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui 
                         officia deserunt mollit anim id est laborum.
                </blockquote>
                
                <br/><br/>
                
            </div>    
                
                <div class="inborderbottom">
                </div>
                
            </div>
            
       </body>
        
    </html>    
        
        
_END;




?>