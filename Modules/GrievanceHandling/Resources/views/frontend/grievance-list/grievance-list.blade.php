@extends('frontend.layouts.master')
@section('content')
<section class="grievance-list">
    <div class="container">
        <div class="row mt-3">
            <h2>तपाईंको गुनासो/उजुरीको स्थिती थाहा पाउन ।</h2>
        <table class="table">
          <thead>
            <tr>
                <th>सि.न</th>
              <th>आवेदन.न</th>
              <th>गुनासो प्रकार</th>
              <th>स्थिति</th>
              <th>प्रकाशित मिति</th>
              <th>प्रतिक्रिपा</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>१.</td>
              <td>२५४५२</td>
              <td>लागुपदार्थ को दुरुपयोग</td>
                <td class="d-flex">
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Reply">
                        <i class="fa-solid fa-reply"></i>
                      </button>
                      <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="View">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Investigation">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Cancel">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </td>
                <td>२०७९-०६-०६</td>
                <td>
                    <button class="btn btn-download btn-light">
                       <a href="#"><i class="fa-solid fa-eye"></i></a>
                    </button>
                </td>
                
            </tr>      
            <tr class="bg-gray">
                <td>१.</td>
                <td>२५४५२</td>
                <td>लागुपदार्थ को दुरुपयोग</td>
                  <td class="d-flex">
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Reply">
                        <i class="fa-solid fa-reply"></i>
                      </button>
                      <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="View">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Investigation">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Cancel">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                  </td>
                  <td>२०७९-०६-०६</td>
                  <td>
                      <button class="btn btn-download btn-light">
                          <i class="fa-solid fa-eye"></i>
                      </button>
                  </td>
            </tr>
            <tr class="danger">
                <td>१.</td>
                <td>२५४५२</td>
                <td>लागुपदार्थ को दुरुपयोग</td>
                  <td class="d-flex">
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Reply">
                        <i class="fa-solid fa-reply"></i>
                      </button>
                      <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="View">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Investigation">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Cancel">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                  </td>
                  <td>२०७९-०६-०६</td>
                  <td>
                      <button class="btn btn-download btn-light">
                          <i class="fa-solid fa-eye"></i>
                      </button>
                  </td>
            </tr>
            <tr class="info">
                <td>१.</td>
                <td>२५४५२</td>
                <td>लागुपदार्थ को दुरुपयोग</td>
                  <td class="d-flex">
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Reply">
                        <i class="fa-solid fa-reply"></i>
                      </button>
                      <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="View">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Investigation">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Cancel">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                  </td>
                  <td>२०७९-०६-०६</td>
                  <td>
                      <button class="btn btn-download btn-light">
                          <i class="fa-solid fa-eye"></i>
                      </button>
                  </td>
            </tr>
            <tr class="warning">
                <td>१.</td>
                <td>२५४५२</td>
                <td>लागुपदार्थ को दुरुपयोग</td>
                  <td class="d-flex">
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Reply">
                        <i class="fa-solid fa-reply"></i>
                      </button>
                      <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="View">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Investigation">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Cancel">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                  </td>
                  <td>२०७९-०६-०६</td>
                  <td>
                      <button class="btn btn-download btn-light">
                          <i class="fa-solid fa-eye"></i>
                      </button>
                  </td>
            </tr>
            <tr class="active">
                <td>१.</td>
                <td>२५४५२</td>
                <td>लागुपदार्थ को दुरुपयोग</td>
                  <td class="d-flex">
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Reply">
                        <i class="fa-solid fa-reply"></i>
                      </button>
                      <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="View">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Investigation">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="bottom" title="Cancel">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                  </td>
                  <td>२०७९-०६-०६</td>
                  <td>
                      <button class="btn btn-download btn-light">
                          <i class="fa-solid fa-eye"></i>
                      </button>
                  </td>
            </tr>
          </tbody>
        </table>
        </div> 
      </div>
</section>
@endsection
