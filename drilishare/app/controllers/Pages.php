<!--*** SECTION 3-16 + 3-17 ***-->
<?php
      class Pages extends Controller {
            public function __construct() {

            }

            public function index() {
                  $data = [
                        'title' => 'DriliShare',
                        'description' => 'Blog Network using MVC-framework PHP Object Oriented Programming.'
                  ];

                  $this->view('pages/index', $data);
            }

            public function about() {
                  $data = [
                        'title' => 'About Us',
                        'description' => 'Application to share posts and blogs'
                  ];
                  $this->view('pages/about', $data);
            }
      }
?>
