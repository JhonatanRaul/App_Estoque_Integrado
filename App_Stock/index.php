<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Stock - Reports</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="libs/node_modules/bootstrap/dist/css/bootstrap.min.css">
    
    
    <!-- jQuery-UI CSS -->
    <link rel="stylesheet" href="libs/jquery-ui/jquery-ui.min.css">

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
                            <a class="nav-link active" href="#">
                              <span data-feather="bar-chart-2"></span>
                              Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
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
                            <a class="nav-link" href="./materials.php">
                              <span data-feather="layers"></span>
                              Materials
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-7 col-sm-9 col-auto ml-auto col-md-9 ml-sm-auto col-lg-10 px-4">
                <h1 class="h2">Purchased materials report</h1>
                <div class="my-4 w-100" id="accordion">
                    <h3>Filter</h3>
                    <form name="form-reports-filter">
                          <div class="form-group">
                            <label for="material">Material:</label>
                            <input type="text" class="form-control" id="material" name="material" placeholder="Enter material name">
                          </div>
                          <div class="form-group">
                            <label for="supplier">Supplier:</label>
                            <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Enter supplier name">
                          </div>
                          <div class="form-group">
                                <div class="mb-1">Purchased date:</div>
                                
                                <div class="w100perHauto">
                                    <div class="w100px mr-1">
                                        <label for="_dtMin">From:</label>
                                        <input type="text" id="_dtMin" name="_dtMin" class="form-control" placeholder="01/01/2019">
                                    </div>

                                    <div class="w100px mr-1">
                                        <label for="_dtMax">to:</label>
                                        <input type="text" id="_dtMax" name="_dtMax" class="form-control" placeholder="31/12/2019">
                                    </div>
                                </div>
                          </div>
                          <div class="form-group">
                                <div class="mb-1">Average unit cost:</div>
                                
                                <div class="w100perHauto">
                                    <div class="w100px mr-1">
                                        <label for="_avgUcMin">Mín: $</label>
                                        <input pattern="^\d*(\.\d{0,2})?$" id="_avgUcMin" name="_avgUcMin" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" placeholder="0.00">
                                    </div>

                                    <div class="w100px mr-1">
                                        <label for="_avgUcMax">Máx: $</label>
                                        <input pattern="^\d*(\.\d{0,2})?$" id="_avgUcMax" name="_avgUcMax" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" placeholder="0.00">
                                    </div>
                                </div>
                          </div>
                          <button type="submit" class="btn btn-secondary" disabled>Filter</button>
                    </form>
                </div>
                <div id="msg-result" class="mt-3 alert d-none"></div>
                    
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Id Purchased</th>
                                <th>Name</th>
                                <th>Total Qtd</th>
                                <th>Average Unit Cost</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-reports">
                           <!--
                            <tr>
                                <td>0</td>
                                <td>Caneta</td>
                                <td>50</td>
                                <td>$ 0.50</td>
                                <td>DETAILS</td>
                            </tr>
                            -->
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <script src="libs/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="libs/jquery-ui/jquery-ui.min.js"></script>
    <script src="libs/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="libs/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="js/stock.js"></script>
    <script src="js/reports.js"></script>
</body>

</html>