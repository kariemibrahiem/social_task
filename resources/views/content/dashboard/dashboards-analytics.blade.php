@extends('layouts/contentNavbarLayout')

@section('title', trns("Dashboard"))

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<style>
  .layout-page {
    overflow-x: hidden !important;
  }

  .layout-wrapper {
    overflow-x: hidden !important;
  }

  .analytics-dashboard-skin {
    background: #f8f9fa;
  }

  .kpi-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    padding: 24px;
    margin-bottom: 16px;
  }

  .kpi-card-mint {
    background: #e8f5f0;
  }

  .kpi-card-sky {
    background: #e0f4ff;
  }

  .kpi-card-cyan {
    background: #d0f4ff;
  }

  .kpi-card-yellow {
    background: #fff9e6;
  }

  .kpi-number {
    font-size: 36px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 12px 0;
  }

  .kpi-label {
    font-size: 12px;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
  }

  .kpi-subtext {
    font-size: 13px;
    color: #0da574;
    font-weight: 500;
  }

  .kpi-icon {
    font-size: 24px;
    margin-bottom: 8px;
  }

  .table-project {
    font-size: 13px;
  }

  .progress-bar-thin {
    height: 6px;
    border-radius: 3px;
  }

  .status-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
  }

  .status-on-track {
    background: #e0f4ff;
    color: #0da574;
  }

  .status-delayed {
    background: #ffe0e0;
    color: #d32f2f;
  }

  .status-at-risk {
    background: #fff9e6;
    color: #f0ad4e;
  }

  .status-completed {
    background: #e8f5f0;
    color: #0da574;
  }
</style>

<div class="analytics-dashboard-skin" style="padding: 20px 30px 100px 30px;">
  <div class="row">
    <div class="col-lg-8 mb-4 order-0">

      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <div class="kpi-card kpi-card-mint">
            <div class="d-flex justify-content-between align-items-flex-start">
              <div>
                <div class="kpi-label">{{ trns('Total Users') }}</div>
                <div class="kpi-number">{{ $usersCount }}</div>
                <div class="kpi-subtext">{{ trns('Registered Users') }}</div>
              </div>
              <div class="kpi-icon">�</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="kpi-card kpi-card-sky">
            <div class="d-flex justify-content-between align-items-flex-start">
              <div>
                <div class="kpi-label">{{ trns('Total Posts') }}</div>
                <div class="kpi-number">{{ $postsCount }}</div>
                <div class="kpi-subtext">{{ trns('Published Posts') }}</div>
              </div>
              <div class="kpi-icon">�</div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="kpi-card kpi-card-yellow">
            <div class="d-flex justify-content-between align-items-flex-start">
              <div>
                <div class="kpi-label">{{ trns('Connections') }}</div>
                <div class="kpi-number">{{ $connectionsCount }}</div>
                <div class="kpi-subtext">{{ trns('Active Connections') }}</div>
              </div>
              <div class="kpi-icon">🤝</div>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
      <div class="card-body p-4">
        <h5 class="mb-4" style="font-size: 16px; font-weight: 600; color: #1a1a1a;">Active Projects</h5>
        
        <div class="table-responsive">
          <table class="table table-borderless table-project">
            <thead>
              <tr style="border-bottom: 1px solid #e0e0e0;">
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Name') }}</th>
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Progress') }}</th>
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Status') }}</th>
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Assigned') }}</th>
                <th style="color: #666; font-weight: 600; font-size: 12px; text-transform: uppercase;">{{ trns('Actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr style="border-bottom: 1px solid #f0f0f0;">
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Website Redesign</div>
                  <div style="font-size: 11px; color: #999;">Jan 30, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 65%; background: #00bcd4; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">65%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-on-track">On Track</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/1.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #c3e9ed;">
                    <img src="{{asset('assets/img/avatars/2.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #d4f1d4;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
              
              <tr style="border-bottom: 1px solid #f0f0f0;">
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Marketing Campaign</div>
                  <div style="font-size: 11px; color: #999;">Feb 10, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 20%; background: #ff6b6b; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">20%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-delayed">Delayed</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/3.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #ffe0e0;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
              
              <tr style="border-bottom: 1px solid #f0f0f0;">
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Mobile App Development</div>
                  <div style="font-size: 11px; color: #999;">Mar 1, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 45%; background: #ffc107; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">45%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-at-risk">At Risk</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/4.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #fff9e6;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
              
              <tr style="border-bottom: 1px solid #f0f0f0;">
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Customer Portal Upgrade</div>
                  <div style="font-size: 11px; color: #999;">Feb 15, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 89%; background: #00bcd4; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">89%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-on-track">On Track</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/5.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #d4f1d4;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
              
              <tr>
                <td style="padding: 16px 0;">
                  <div style="font-weight: 500; color: #1a1a1a;">Product Launch</div>
                  <div style="font-size: 11px; color: #999;">Jan 29, 2025</div>
                </td>
                <td style="padding: 16px 0;">
                  <div style="max-width: 80px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                      <div style="width: 100%; background: #f0f0f0; border-radius: 3px; height: 6px;">
                        <div style="width: 100%; background: #4caf50; height: 6px; border-radius: 3px;"></div>
                      </div>
                      <span style="font-size: 12px; color: #666;">100%</span>
                    </div>
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <span class="status-badge status-completed">Completed</span>
                </td>
                <td style="padding: 16px 0;">
                  <div style="display: flex; margin-left: -8px;">
                    <img src="{{asset('assets/img/avatars/6.png')}}" alt="User" style="width: 32px; height: 32px; border-radius: 50%; border: 2px solid white; margin-left: -8px; background: #e8f5f0;">
                  </div>
                </td>
                <td style="padding: 16px 0;">
                  <i class="bx bx-dots-vertical-rounded" style="cursor: pointer;"></i>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <div style="text-align: center; padding: 16px 0;">
          <a href="#" style="color: #00bcd4; text-decoration: none; font-weight: 500; font-size: 13px;">View All Projects</a>
        </div>
      </div>
    </div>
  </div> -->

      <!-- <div class="col-lg-4 col-md-4 order-1">

        <div class="card mb-4" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
          <div class="card-body p-4">
            <h5 style="font-size: 16px; font-weight: 600; color: #1a1a1a; margin-bottom: 24px;">{{ trns('Task Progress') }}</h5>

            <div style="text-align: center; margin-bottom: 24px;">
              <div style="font-size: 48px; font-weight: 700; color: #1a1a1a;">64%</div>
            </div>

            <div style="margin-bottom: 20px;">
              <div style="display: flex; gap: 4px; height: 6px; border-radius: 3px; overflow: hidden;">
                <div style="flex: 24%; background: #00bcd4;"></div>
                <div style="flex: 35%; background: #4caf50;"></div>
                <div style="flex: 41%; background: #ff9800;"></div>
              </div>
            </div>

            <div style="display: flex; justify-content: space-between; padding-top: 12px; border-top: 1px solid #f0f0f0;">
              <div style="text-align: center; flex: 1;">
                <div style="font-size: 12px; color: #999; margin-bottom: 4px;">24%</div>
              </div>
              <div style="text-align: center; flex: 1;">
                <div style="font-size: 12px; color: #999; margin-bottom: 4px;">35%</div>
              </div>
              <div style="text-align: center; flex: 1;">
                <div style="font-size: 12px; color: #999; margin-bottom: 4px;">41%</div>
              </div>
            </div>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-4">
            <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); text-align: center; padding: 20px;">
              <div style="width: 48px; height: 48px; border-radius: 50%; background: #e8f5f0; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                <i class="bx bx-check-circle" style="color: #0da574; font-size: 24px;"></i>
              </div>
              <div style="font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px;">8</div>
              <div style="font-size: 11px; color: #999;">Completed</div>
            </div>
          </div>
          <div class="col-4">
            <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); text-align: center; padding: 20px;">
              <div style="width: 48px; height: 48px; border-radius: 50%; background: #e0f4ff; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                <i class="bx bx-loader-circle" style="color: #00bcd4; font-size: 24px;"></i>
              </div>
              <div style="font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px;">12</div>
              <div style="font-size: 11px; color: #999;">In-Progress</div>
            </div>
          </div>
          <div class="col-4">
            <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08); text-align: center; padding: 20px;">
              <div style="width: 48px; height: 48px; border-radius: 50%; background: #ffe0e0; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                <i class="bx bx-error-circle" style="color: #d32f2f; font-size: 24px;"></i>
              </div>
              <div style="font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px;">14</div>
              <div style="font-size: 11px; color: #999;">Up Coming</div>
            </div>
          </div>
        </div>

        <div class="card mb-4" style="border: none; border-radius: 12px; background: linear-gradient(135deg, #0da574 0%, #00bcd4 100%); color: white; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12); padding: 24px; text-align: center;">
          <div style="font-size: 48px; margin-bottom: 16px;">🤖</div>
          <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: white;">{{ trns('How AI assist will') }}<br>{{ trns('help you') }}?</h5>
          <button class="btn" style="background: white; color: #0da574; font-weight: 600; padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer; font-size: 12px;">{{ trns('Start AI') }}</button>
        </div>

        <div class="card" style="border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
          <div class="card-body p-4">
            <div style="font-size: 12px; color: #999; text-transform: uppercase; margin-bottom: 8px;">{{ trns('Project Budget') }}</div>
            <div style="font-size: 12px; color: #666; margin-bottom: 16px;">Budget Allocation Overview:</div>
            <div style="font-size: 32px; font-weight: 700; color: #1a1a1a;">$50,000</div>
          </div>
        </div>
      </div> -->

      <!-- <div class="col-12 w-100 order-3 order-md-2">
        <div class="row w-100">

          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="bx bx-chalkboard" style="font-size: 1.75rem;"></i>
                  </div>
                  <div class="dropdown-menu-end">

                  </div>
                </div>
                <span>{{ trns("teachers") }}</span>

              </div>
            </div>
          </div>

          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="bx bx-user" style="font-size: 1.75rem;"></i>
                  </div>
                  <div class=" dropdown-menu-end">

                  </div>
                </div>
                <span>{{ trns("families") }}</span>

              </div>
            </div>
          </div>

          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{asset('assets/img/icons/unicons/paypal.png')}}" alt="Payments" class="rounded">
                  </div>
                  <div class=" dropdown-menu-end">

                  </div>
                </div>
                <span class="d-block mb-1">{{ trns("Payments") }}</span>

              </div>
            </div>
          </div>

          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{asset('assets/img/icons/unicons/cc-primary.png')}}" alt="Transactions" class="rounded">
                  </div>
                  <div class=" dropdown-menu-end">

                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">{{ trns("Transactions") }}</span>

              </div>
            </div>
          </div>
        </div>

      </div> -->
    </div>
  </div>
  <div class="row" @if(app()->getLocale() == 'ar') style="margin-top: 25rem;" @endif>

    <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4 " style="margin-bottom: 50px;">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
          <div class="card-title mb-0">
            <h5 class="m-0 me-2">{{ trns("Latest Users") }}</h5>
          </div>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
            @foreach($latestUsers as $user)
            <li class="d-flex mb-4 pb-1">
              <div class="avatar flex-shrink-0 me-3">
                @if($user->image)
                <img src="{{ imageUrl($user->image) }}" alt="{{ $user->name }}" class="rounded" style="width:38px;height:38px;object-fit:cover;">
                @else
                <span class="avatar-initial rounded bg-label-primary">
                  {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>
                @endif
              </div>
              <div class="d-flex w-100 align-items-center justify-content-between flex-nowrap gap-2">
                <div class="me-2 flex-grow-1 text-truncate">
                  <h6 class="mb-0">{{ $user->name }}</h6>
                  <small class="text-muted">{{ $user->email }}</small>
                </div>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    <!-- <div class="col-md-6 col-lg-4 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">{{ trns("orders") }}</h5>

        </div>

        <div class="card-body">

          <div class="d-flex p-4 pt-3">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{ asset('assets/img/icons/unicons/cc-success.png') }}" alt="Transactions" class="rounded">
            </div>
            <div>
              <small class="text-muted d-block">{{ trns('Last 5 Orders') }}</small>
            </div>
          </div>

          <ul class="list-unstyled mb-0">

          </ul>
        </div>
      </div>
    </div> -->

    <!-- <div class="col-md-6 col-lg-4 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">{{ trns("Transactions") }}</h5>

        </div>

        <div class="card-body">

          <div class="d-flex p-4 pt-3">
            <div class="avatar flex-shrink-0 me-3">
              <img src="{{ asset('assets/img/icons/unicons/cc-success.png') }}" alt="Transactions" class="rounded">
            </div>
            <div>
              <small class="text-muted d-block">{{ trns('Last 5 Transactions') }}</small>
            </div>
          </div>

          <ul class="list-unstyled mb-0">

          </ul>
        </div>
      </div>
    </div> -->

  </div>
  @endsection