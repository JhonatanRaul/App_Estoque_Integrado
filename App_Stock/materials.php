<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Stock - Materials</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="libs/node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="css/stock.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Stock App</a>
        <!--
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        -->
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-5 col-sm-3 col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="./">
                              <span data-feather="bar-chart-2"></span>
                              Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./buy.php">
                              <span data-feather="shopping-cart"></span>
                              Buy
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>stock details</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="./suppliers.php">
                              <span data-feather="users"></span>
                              Suppliers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                              <span data-feather="layers"></span>
                              Materials
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-7 col-sm-9 col-auto ml-auto col-md-9 ml-sm-auto col-lg-10 px-4">
               <h2 class="h2 pt-3">New Material Standard</h2>
                <div class="my-4 w-100">
                    <form>
                      <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                      </div>
                      <div class="form-group">
                          <label for="max-cost">Maximum cost:</label>
                          <div class="input-group mb-3">
                              <label for="max-cost">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                  </div>
                              </label>
                              <input type="text" id="max-cost" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" placeholder="0.00">
                          </div>
                      </div>
                      <button type="submit" class="btn btn-secondary">Save</button>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qtd</th>
                                <th>Unity Cost</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Caneta</td>
                                <td>50</td>
                                <td>$ 0.50</td>
                                <td>DETAILS</td>
                            </tr>
                            <tr>
                                <td>Lápis</td>
                                <td>30</td>
                                <td>$ 0.35</td>
                                <td>DETAILS</td>
                            </tr>
                            <tr>
                                <td>Caneta</td>
                                <td>50</td>
                                <td>$ 0.50</td>
                                <td>DETAILS</td>
                            </tr>
                            <tr>
                                <td>Lápis</td>
                                <td>30</td>
                                <td>$ 0.35</td>
                                <td>DETAILS</td>
                            </tr>
                            <tr>
                                <td>Caneta</td>
                                <td>50</td>
                                <td>$ 0.50</td>
                                <td>DETAILS</td>
                            </tr>
                            <tr>
                                <td>Lápis</td>
                                <td>30</td>
                                <td>$ 0.35</td>
                                <td>DETAILS</td>
                            </tr>
                            <tr>
                                <td>Caneta</td>
                                <td>50</td>
                                <td>$ 0.50</td>
                                <td>DETAILS</td>
                            </tr>
                            <tr>
                                <td>Lápis</td>
                                <td>30</td>
                                <td>$ 0.35</td>
                                <td>DETAILS</td>
                            </tr>
                            <tr>
                                <td>Caneta</td>
                                <td>50</td>
                                <td>$ 0.50</td>
                                <td>DETAILS</td>
                            </tr>
                            <tr>
                                <td>Lápis</td>
                                <td>30</td>
                                <td>$ 0.35</td>
                                <td>DETAILS</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="libs/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="js/stock.js"></script>
</body>

</html>
