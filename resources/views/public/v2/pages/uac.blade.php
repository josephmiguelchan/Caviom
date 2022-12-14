@extends('public.v2.public_master')

@section('title', 'User Access Control List')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        <h2>User Access Control List</h2>
        <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li>User Access Control List</li>
        </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">
                            <strong>Public Users / Leads</strong>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>View Public Pages</td>
                        <td>Home, Contact, About, and Services Page.</td>
                    </tr>
                    <tr>
                        <td>View Charitable Organizations</td>
                        <td>About Us, Programs & Activities, Featured Projects, and Donation Modes.</td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">
                            <strong>Charity Admins</strong>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Account Management</td>
                        <td>Register, Login, Logout, and Forget Password.</td>
                    </tr>
                    <tr>
                        <td>Dashboard</td>
                        <td>View Statistic Data in the Dashboard.</td>
                    </tr>
                    <tr>
                        <td>Manage Leads</td>
                        <td>View Leads, Delete Leads, and Move Leads to Prospect</td>
                    </tr>
                    <tr>
                        <td>Manage Prospects</td>
                        <td>View Prospect, Move Back to Leads, Add to Opportunity and Generate Cash Donation Inflow Report (PDF).</td>
                    </tr>
                    <tr>
                        <td rowspan="4">Manage Projects</td>
                    </tr>
                    <tr>
                        <td>View, Add, Edit, Delete Projects.</td>
                    </tr>
                    <tr>
                        <td>View, Add, Edit and Delete Tasks.</td>
                    </tr>
                    <tr>
                        <td>Add New Featured Projects, and Feature Existing Projects.</td>
                    </tr>
                    <tr>
                        <td>Manage Users</td>
                        <td>View, Unlock Users, and Backup Users list (Excel).</td>
                    </tr>
                    <tr>
                        <td rowspan="3">Manage Beneficiaries</td>
                    </tr>
                    <tr>
                        <td>View all, Add Beneficiary, and Backup Beneficiaries (Excel).</td>
                    </tr>
                    <tr>
                        <td>Generate Selected Beneficiary (PDF), Edit and Delete Beneficiary.</td>
                    </tr>
                    <tr>
                        <td>Manage Benefactors</td>
                        <td>View, Add, Edit, Delete and Backup Benefactors (Excel).</td>
                    </tr>
                    <tr>
                        <td>Manage Volunteers</td>
                        <td>View, Add, Edit, Delete and Backup Volunteers (Excel).</td>
                    </tr>
                    <tr>
                        <td rowspan="3">Manage Gift Giving</td>
                    </tr>
                    <tr>
                        <td>Add new, and View Gift Giving Project.</td>
                    </tr>
                    <tr>
                        <td>Add and Delete Participants of Gift Giving Project, and Generate Tickets.</td>
                    </tr>
                    <tr>
                        <td>Manage Audit Logs</td>
                        <td>View All Organization's Audit Logs.</td>
                    </tr>
                    <tr>
                        <td>Manage Star Tokens</td>
                        <td>Order Star Tokens/Subscription, and View Transactions History.</td>
                    </tr>
                    <tr>
                        <td>Manage Notifications</td>
                        <td>View all, View details of and Delete Notifications.</td>
                    </tr>
                    <tr>
                        <td>Manage Personal Profile</td>
                        <td>Edit Profile and Change Password.</td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">
                            <strong>Charity Associates</strong>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Account Management</td>
                        <td>Register, Login, Logout, and Forget Password.</td>
                    </tr>
                    <tr>
                        <td>Dashboard</td>
                        <td>View Statistic Data in the Dashboard.</td>
                    </tr>
                    <tr>
                        <td>Manage Leads</td>
                        <td>View Leads, Delete Leads, and Move Leads to Prospect</td>
                    </tr>
                    <tr>
                        <td>Manage Prospects</td>
                        <td>View Prospect, Move Back to Leads, Add to Opportunity and Generate Cash Donation Inflow Report (PDF).</td>
                    </tr>
                    <tr>
                        <td rowspan="3">Manage Projects</td>
                    </tr>
                    <tr>
                        <td>View Project.</td>
                    </tr>
                    <tr>
                        <td>View, Add, Edit and Delete Task.</td>
                    </tr>
                    <tr>
                        <td>Manage Users</td>
                        <td>View Users, and Backup User list (Excel).</td>
                    </tr>
                    <tr>
                        <td rowspan="3">Manage Beneficiaries</td>
                    </tr>
                    <tr>
                        <td>View all, Add Beneficiary, and Backup Beneficiary list (Excel).</td>
                    </tr>
                    <tr>
                        <td>Generate Selected Beneficiary (PDF), Edit and Delete Beneficiary.</td>
                    </tr>
                    <tr>
                        <td>Manage Benefactors</td>
                        <td>View, Add, Edit, Delete and Backup Benefactors (Excel).</td>
                    </tr>
                    <tr>
                        <td>Manage Volunteers</td>
                        <td>View, Add, Edit, Delete and Backup Volunteers (Excel).</td>
                    </tr>
                    <tr>
                        <td rowspan="3">Manage Gift Giving</td>
                    </tr>
                    <tr>
                        <td>View Gift Giving Project.</td>
                    </tr>
                    <tr>
                        <td>Add and Delete Participants of Gift Giving Project, and Generate Tickets.</td>
                    </tr>
                    <tr>
                        <td>Manage Notifications</td>
                        <td>View all, View details of and Delete Notifications.</td>
                    </tr>
                    <tr>
                        <td>Manage Personal Profile</td>
                        <td>Edit Profile and Change Password.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection