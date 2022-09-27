
 <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item nav-category">PROPERTIES INFORMATION</li>
          @if( Auth::user()->can('Apartments.view'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#apartment" aria-expanded="false" aria-controls="apartment">
              <i class="menu-icon mdi mdi mdi-bank"></i>
              <span class="menu-title">Apartments Details</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="apartment">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('/apartments') }}"> View Apartments</a></li>                 
              </ul>
            </div>
          </li>
          @endif
          @if( Auth::user()->can('Housecategories.view'))
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#housecategories" aria-expanded="false" aria-controls="housecategories">
              <i class="menu-icon mdi mdi-home-modern"></i>
              <span class="menu-title">House Categories</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="housecategories">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ url('/housecategories') }}"> View House Categories</a></li>                 
              </ul>
            </div>
          </li>
          @endif
          
         <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#house" aria-expanded="false" aria-controls="house">
              <i class="menu-icon mdi mdi-home-map-marker"></i>
              <span class="menu-title">Houses</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="house">
              <ul class="nav flex-column sub-menu">
              @if( Auth::user()->can('House.view'))
                <li class="nav-item"><a class="nav-link" href="{{ url('/house') }}">View All </a></li>
              @endif
              @if( Auth::user()->can('House.create'))  
                  <li class="nav-item"><a class="nav-link" href="{{ url('/add-house') }}">Add Houses</a></li>
              @endif    
              </ul>
            </div>
          </li>
          
          
           <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#Tenants" aria-expanded="false" aria-controls="Tenants">
              <i class="menu-icon mdi mdi-human"></i>
              <span class="menu-title">Tenants</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Tenants">
              <ul class="nav flex-column sub-menu">
              @if( Auth::user()->can('Tenants.view'))
                <li class="nav-item"><a class="nav-link" href="{{ url('/tenants') }}">Tenant View</a></li>
              @endif  
                @if( Auth::user()->can('Tenants.create'))
                  <li class="nav-item"><a class="nav-link" href="{{ url('/add-tenants') }}">Tenant Registration</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Tenant In Form</a></li>
                  @endif
                </ul>
            </div>
          </li>

          <li class="nav-item nav-category">OPERATIONS</li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Utilities</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
            @if( Auth::user()->can('Utilitycategories.view'))
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/utilitycategories') }}">Utilities Types</a></li> 
              </ul>
            @endif  
            @if( Auth::user()->can('Readings.view'))
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/readings') }}">Meter Readings</a></li>
              </ul>
            @endif  
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#Lease" aria-expanded="false" aria-controls="Lease">
              <i class="menu-icon mdi mdi mdi-key"></i>
              <span class="menu-title">Lease</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Lease">
              <ul class="nav flex-column sub-menu">
              @if( Auth::user()->can('Lease.view'))
                <li class="nav-item"><a class="nav-link" href="{{ url('/leases') }}"> View Leases</a></li>
              @endif
              @if( Auth::user()->can('Lease.create')) 
                  <li class="nav-item"><a class="nav-link" href="{{ url('/add-lease') }}">Assign Lease</a></li>
              @endif    
              </ul>
            </div>
          </li>

                    <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#invoices" aria-expanded="false" aria-controls="invoices">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Invoices</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="invoices">
              <ul class="nav flex-column sub-menu">
              @if( Auth::user()->can('House.view'))
                <li class="nav-item"> <a class="nav-link" href="{{ url('/invoices') }}"> Invoice List</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/invoices') }}"> Due Invoices</a></li>
              @endif  
              </ul>
            </div>
          </li>


          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="menu-icon mdi mdi-cash-usd"></i>
              <span class="menu-title">Payments</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
              @if( Auth::user()->can('Paymenttypes.view'))  
                <li class="nav-item"> <a class="nav-link" href="{{ url('/paymenttypes') }}">Payments Types</a></li>
              @endif  
              @if( Auth::user()->can('Payments.view'))
                <li class="nav-item"> <a class="nav-link" href="{{ url('/payments') }}">List of Payments</a></li>
              @endif  
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#maintenance" aria-expanded="false" aria-controls="maintenance">
            <i class="menu-icon mdi mdi-broom"></i>
              <span class="menu-title">Maintenance</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="maintenance">
            @if( Auth::user()->can('Maintenance.view'))
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/YearViewmaintenance') }}">All Repairs</a></li>
              </ul>
            @endif
            @if( Auth::user()->can('Repairwork.view'))  
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/YearViewrepairwork') }}">Job Work Orders</a></li>
              </ul>
            @endif  
            </div>
          </li>
          @if( Auth::user()->can('Users.view'))  
          <li class="nav-item nav-category">Settings</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">User Controls</span>
              <i class="menu-arrow"></i>
            </a>
          @endif
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
              @if( Auth::user()->can('Users.view'))  
                <li class="nav-item"> <a class="nav-link" href="{{ url('/users') }}">All Users </a></li>
                @endif
                @if( Auth::user()->can('roles.show'))  
                <li class="nav-item"> <a class="nav-link" href="{{ url('/roles') }}">Roles </a></li>
                @endif
                @if( Auth::user()->can('permissions.show'))  
                <li class="nav-item"> <a class="nav-link" href="{{ url('/permissions') }}">Permissions </a></li>
                @endif
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Messages</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#messages" aria-expanded="false" aria-controls="messages">
            <i class="menu-icon mdi mdi-email-open"></i>
              <span class="menu-title">Emails</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="messages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/sent-invoice-emails') }}">Invoice Emails</a></li>
              </ul>
              
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/readings') }}">Send Email</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#SMS" aria-expanded="false" aria-controls="SMS">
              <i class="menu-icon mdi mdi-message-text-outline"></i>
              <span class="menu-title">SMS</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="SMS">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/utilitycategories') }}">Sent SMS</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/readings') }}">Send SMS</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Reports</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">Report Per Month</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
