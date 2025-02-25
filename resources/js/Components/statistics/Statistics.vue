<template>
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-widget w-100">
                <div class="dash-widgetimg">
                    <span><img src="Assets/icons/dash1.svg" alt="img" /></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        $
                        <vue3-autocounter class="counters" ref="counter" :startAmount="107144.0" :delay="3"
                            :endAmount="307144.0" :duration="5" :autoinit="true" />
                    </h5>
                    <h6>Total Purchase Due</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-widget dash1 w-100">
                <div class="dash-widgetimg">
                    <span><img src="Assets/icons/dash2.svg" alt="img" /></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        $
                        <vue3-autocounter class="counters" ref="counter" :startAmount="1385.0" :delay="3"
                            :endAmount="4385.0" :duration="5" :autoinit="true" />
                    </h5>
                    <h6>Total Sales Due</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-widget dash2 w-100">
                <div class="dash-widgetimg">
                    <span><img src="Assets/icons/dash3.svg" alt="img" /></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        $
                        <vue3-autocounter class="counters" ref="counter" :startAmount="185656.5" :delay="3"
                            :endAmount="385656.5" :duration="5" :autoinit="true" />
                    </h5>
                    <h6>Total Sale Amount</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-widget dash3 w-100">
                <div class="dash-widgetimg">
                    <span><img src="Assets/icons/dash4.svg" alt="img" /></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        $
                        <vue3-autocounter class="counters" ref="counter" :startAmount="10000.0" :delay="3"
                            :endAmount="40000.0" :duration="5" :autoinit="true" />
                    </h5>
                    <h6>Total Expense Amount</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>100</h4>
                    <h5>Customers</h5>
                </div>
                <div class="dash-imgs">
                    <vue-feather type="user"></vue-feather>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4>110</h4>
                    <h5>Suppliers</h5>
                </div>
                <div class="dash-imgs">
                    <vue-feather type="user-check"></vue-feather>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4>150</h4>
                    <h5>Purchase Invoice</h5>
                </div>
                <div class="dash-imgs">
                    <img src="Assets/icons/file-text-icon-01.svg" class="img-fluid" alt="icon" />
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4>170</h4>
                    <h5>Sales Invoice</h5>
                </div>
                <div class="dash-imgs">
                    <vue-feather type="file"></vue-feather>
                </div>
            </div>
        </div>
    </div>
</template>