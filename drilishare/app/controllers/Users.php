<?php
      class Users extends Controller {
            public function __construct() {
                  $this->userModel = $this->model('User');
            }

            public function register() {
                  // Check for POST
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // Process the form

                        // Sanitize POST data
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                        // (init data)
                        $data = [
                              'name'                        => trim($_POST['name']),
                              'email'                       => trim($_POST['email']),
                              'password'                    => trim($_POST['password']),
                              'confirm_password'            => trim($_POST['confirm_password']),
                              'name_error'                  => '',
                              'email_error'                 => '',
                              'password_error'              => '',
                              'confirm_password_error'      => ''
                        ];

                        // Validate Email
                        if (empty($data['email'])) {
                              $data['email_error'] = 'Please enter email';
                        } else {
                              // Check email if exists
                              if ($this->userModel->findUserByEmail($data['email'])) {
                                    $data['email_error'] = 'Email is already taken';
                              }
                        }

                        // Validate Name
                        if (empty($data['name'])) {
                              $data['name_error'] = 'Please enter name';
                        }

                        // Validate Password
                        if (empty($data['password'])) {
                              $data['password_error'] = 'Please enter password';
                        } elseif (strlen($data['password'] < 6) && strlen($data['password_error'] < 6)) {
                              $data['password_error'] = 'Password must be at least 6 characters';
                        }

                        // Validate Confirm Password
                        if (empty($data['confirm_password'])) {
                              $data['confirm_password_error'] = 'Please confirm password';
                        } else {
                              if ($data['password'] != $data['confirm_password']) {
                                    $data['confirm_password_error'] = 'Passwords do not match';
                              }
                        }

                        // Make sure errors are empty
                        if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                              // Validated
                              die('SUCCESS');
                        } else {
                              // Load view with errors
                              $this->view('users/register', $data);
                        }

                  } else {
                        // Load form (init data)
                        $data = [
                              'name'                        => '',
                              'email'                       => '',
                              'password'                    => '',
                              'confirm_password'            => '',
                              'name_error'                  => '',
                              'email_error'                 => '',
                              'password_error'              => '',
                              'confirm_password_error'      => ''
                        ];

                        // Load view
                        $this->view('users/register', $data);
                  }
            }

            public function login() {
                  // Check for POST
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // Process the form
                        // Sanitize POST data
                        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                        // (init data)
                        $data = [
                              'email'                       => trim($_POST['email']),
                              'password'                    => trim($_POST['password']),
                              'email_error'                 => '',
                              'password_error'              => ''
                        ];

                        // Validate Email
                        if (empty($data['email'])) {
                              $data['email_error'] = 'Please enter email';
                        }

                        // Validate Password
                        if (empty($data['password'])) {
                              $data['password_error'] = 'Please enter password';
                        }

                        // Make sure errors are empty
                        if (empty($data['email_error']) && empty($data['password_error'])) {
                              // Validated
                              die('SUCCESS');
                        } else {
                              // Load view with errors
                              $this->view('users/login', $data);
                        }
                  } else {
                        // Load form (init data)
                        $data = [
                              'email'                       => '',
                              'password'                    => '',
                              'email_error'                 => '',
                              'password_error'              => ''
                        ];

                        // Load view
                        $this->view('users/login', $data);
                  }
            }

      }

?>
