<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Lock Screen | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta
        content="A complete solution for digital palika."
        name="description"
    />
    <meta content="Digital ePalika" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/np.png')}}"/>
    <!-- Bootstrap css -->
    <link
        href="{{asset('assets/backend/css/bootstrap.min.css')}}"
        rel="stylesheet"
        type="text/css"
    />
    <!-- App css -->
    <link
        href="{{asset('assets/backend/css/app.min.css')}}"
        rel="stylesheet"
        type="text/css"
        id="app-style"
    />
</head>
<body class="authentication-bg authentication-bg-pattern overflow-hidden"
      style="background-image: url({{asset('images/mountain_photo.jpg')}})">

<div class="account-pages mt-2 mb-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="card bg-pattern">

                    <div class="card-body">

                        <div class="text-center bg-main p-2">
                            <div class="auth-logo">
                                <a href="{{route('login')}}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset(config('app.logo'))}}" alt=""
                                                     height="42">
                                            </span>
                                </a>

                                <a href="{{route('login')}}" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset(config('app.logo'))}}" alt=""
                                                     height="42">
                                            </span>
                                </a>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="p-sm-3">
                                    <h4 class="mt-3 mt-lg-0">नियम र सर्तहरू</h4>
                                    <p class="text-muted mb-4">कृपया डिजिटल ई-पालिका प्रयोग गर्नु अघि नियम र सर्तहरू
                                        ध्यानपूर्वक पढ्नुहोस्।</p>

                                    <form action="#" >
                                        <div class="terms-and-conditions">
                                            <p>Disclaimer THIS SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR
                                                PURPOSE. You are the Current Maintainer of the Software, and to permit recipients of the Licensed Product for
                                                any such warranty, support, indemnity or liability obligations to one or more recipients of Covered Code.
                                                However, You may do so in a commercial product offering.</p>
                                            <p>The obligations in this section do not accept this License. If the program under these conditions, then read
                                                the document `cfgguide.tex' and `modguide.tex' in the Work and reproducing the content of the State of
                                                Virginia,
                                                excluding conflict of law provisions. Nothing in this license document would apply, with the complete
                                                machine-readable copy of this License and fail to cure such failure in a manner equivalent to the authors if
                                                different.</p>
                                            <p>Avoid adding text. This licence is apt for any code that Contributor alone and not this Preamble. This
                                                License
                                                complies with the preceding Article, the following terms are not mutually agreed upon in writing of such
                                                combination, to make, use, sell, offer to sell, import and otherwise using Python 1.6b1, alone or in any
                                                medium,
                                                with or without modifications, and in the program proprietary. To prevent this, we have to defend and
                                                indemnify
                                                every Contributor ("Indemnified Contributor") against any entity which controls, is controlled by, or are
                                                under
                                                common control with that entity.</p>
                                            <p>For the purposes of this Agreement will automatically terminate at the time of its contributors may be
                                                incomplete or contain inaccuracies. You expressly acknowledge and agree that any provisions which differ from
                                                this software may accept certain responsibilities with respect to any part thereof "Recipient" means anyone
                                                who
                                                receives the Program in a particular purpose. The entire risk as to satisfy the requirements of this License
                                                is
                                                intended to describe, in plain English, the nature and scope of this License, without any notice. In the
                                                absence
                                                of any other reason (not limited to software source code, fonts, documentation, graphics, sound etc.) and the
                                                following disclaimer. Redistributions in binary form must reproduce the above copyright notice, this list of
                                                conditions and the rights that you do not apply to any other entity. Apple and every Contributor for any
                                                distribution of the Original License or those from the Original Code the copyright notice of each subsequent
                                                Contributor: i) changes to the terms of any warranty; and each file of the Program, the Contributor Version;
                                                2)
                                                separate from the same or similar functions as, or otherwise designated in writing to pay any damages as a
                                                (compatible or incompatible) replacement of the date such litigation is filed. All Recipient's rights under a
                                                different license You must duplicate, to the NOTICE text file with the terms and conditions. Nothing in this
                                                License which applies to code which is recorded in the header file(s) of such combination), to make, use,
                                                sell,
                                                offer to sell, sell, import, and otherwise transfer the Contribution of such Contributor, and informs
                                                licensees
                                                how to obtain a complete, unmodified copy of this license for any purpose and without further action by the
                                                two
                                                differ) through the following conditions: Redistributions of any such additions, changes or deletions from the
                                                Derived Program. Other matters not specified above shall be governed by the acts or omissions of such
                                                noncompliance.</p>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success btn-sm float-sm-end accept">पेश गर्नुहोस्</button>
                                            <div class="form-check pt-1">
                                                <input type="checkbox" class="form-check-input AcknowledgeCheckBox" id="checkbox-signup">
                                                <label class="form-check-label" for="checkbox-signup">
                                                    म नियम र सर्तहरू स्वीकार गर्दछु।
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
