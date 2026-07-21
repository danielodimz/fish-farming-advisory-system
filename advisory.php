<?php include 'includes/lp-header.php' ?>

<style>
/* ===== Advisory Page Custom Styles ===== */
.advisory-hero {
    background: #0e153a;
    border-radius: 12px;
    padding: 40px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
}
.advisory-hero::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(0,209,255,0.08);
}
.advisory-hero h2 { color: #fff; font-size: 2rem; margin-bottom: 10px; }
.advisory-hero p  { color: rgba(255,255,255,0.8); font-size: 1rem; margin-bottom: 20px; }
.advisory-hero .badge-strip {
    display: flex; flex-wrap: wrap; gap: 10px;
}
.advisory-hero .badge-strip span {
    background: rgba(0,209,255,0.15);
    border: 1px solid #00d1ff;
    color: #00d1ff;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 0.82rem;
}

/* Advisory cards */
.adv-card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 28px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.10);
    transition: transform 0.25s, box-shadow 0.25s;
    height: 100%;
}
.adv-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 28px rgba(0,209,255,0.18);
}
.adv-card .card-header {
    background: #0e153a;
    color: #fff;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    border: none;
}
.adv-card .card-header i {
    font-size: 1.6rem;
    color: #00d1ff;
    flex-shrink: 0;
}
.adv-card .card-header h5 {
    margin: 0;
    font-size: 1.05rem;
    font-weight: 600;
}
.adv-card .card-body {
    padding: 20px;
    background: #fff;
}
.adv-card .card-body p, .adv-card .card-body li {
    font-size: 0.9rem;
    color: #444;
}
.adv-card .card-body strong { color: #0e153a; }

/* Problem-Solution strip */
.problem-strip {
    background: #fff3f3;
    border-left: 4px solid #e74c3c;
    border-radius: 0 8px 8px 0;
    padding: 10px 14px;
    margin-bottom: 12px;
    font-size: 0.88rem;
}
.solution-strip {
    background: #f0fff8;
    border-left: 4px solid #27ae60;
    border-radius: 0 8px 8px 0;
    padding: 10px 14px;
    margin-bottom: 6px;
    font-size: 0.88rem;
}
.problem-strip strong { color: #c0392b; }
.solution-strip strong { color: #1e8449; }

/* Water quality table */
.wq-table thead th { background: #0e153a; color: #fff; font-size: 0.82rem; }
.wq-table td, .wq-table th { font-size: 0.82rem; vertical-align: middle; }
.wq-table .badge-ok   { background:#27ae60; color:#fff; padding:2px 8px; border-radius:10px; font-size:0.75rem; }
.wq-table .badge-warn { background:#e67e22; color:#fff; padding:2px 8px; border-radius:10px; font-size:0.75rem; }

/* Feeding table */
.feed-table thead th { background: #1a7a4a; color: #fff; font-size: 0.82rem; }
.feed-table td, .feed-table th { font-size: 0.82rem; }

/* Weather cards */
.weather-badge {
    display: inline-block;
    padding: 3px 12px;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
    margin-bottom: 8px;
}
.weather-hot  { background:#fff0e0; color:#e67e22; border:1px solid #e67e22; }
.weather-rain { background:#e8f4fd; color:#2980b9; border:1px solid #2980b9; }
.weather-dry  { background:#fef9e7; color:#d4ac0d; border:1px solid #d4ac0d; }

/* Tip list */
.tip-list { list-style: none; padding-left: 0; margin: 0; }
.tip-list li { padding: 5px 0 5px 22px; position: relative; font-size: 0.88rem; color: #444; }
.tip-list li::before {
    content: '✓';
    position: absolute; left: 0;
    color: #00d1ff; font-weight: 700;
}

/* CTA Banner */
.adv-cta {
    background: linear-gradient(135deg, #0e153a, #1a7a4a);
    border-radius: 12px;
    padding: 36px 30px;
    text-align: center;
    color: #fff;
    margin-top: 10px;
}
.adv-cta h4 { font-size: 1.3rem; margin-bottom: 10px; }
.adv-cta p  { opacity: 0.85; font-size: 0.92rem; margin-bottom: 20px; }

/* Sidebar enhancements */
.widget-nav-menu ul li.active a, .widget-nav-menu ul li a:hover {
    background: #00d1ff !important;
    color: #0e153a !important;
}

/* Quick-stat bar */
.quick-stats {
    display: flex; flex-wrap: wrap; gap: 12px;
    margin-bottom: 32px;
}
.stat-box {
    flex: 1 1 130px;
    background: #0e153a;
    border-radius: 10px;
    padding: 16px 12px;
    text-align: center;
    color: #fff;
    border-bottom: 3px solid #00d1ff;
}
.stat-box .stat-num { font-size: 1.6rem; font-weight: 700; color: #00d1ff; line-height: 1; }
.stat-box .stat-lbl { font-size: 0.72rem; opacity: 0.75; margin-top: 4px; }
</style>

<!-- page-title -->
<div class="ttm-page-title-row ttm-bg ttm-bgimage-yes ttm-bgcolor-darkgrey clearfix">
    <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="ttm-page-title-row-inner">
                    <div class="page-title-heading">
                        <h2 class="title">Fish Farming Advisory</h2>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <span><a title="Homepage" href="header-overlay.php">Home</a></span>
                        <span>Advisory</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-title end -->

<!--site-main start-->
<div class="site-main">
    <div class="ttm-row sidebar ttm-sidebar-left clearfix">
        <div class="container">
            <div class="row">

                <!-- ===== SIDEBAR ===== -->
                <div class="col-lg-4 widget-area sidebar-left">

                    <!-- Navigation -->
                    <aside class="widget widget-nav-menu">
                        <h3 class="widget-title">Advisory Topics</h3>
                        <ul>
                            <li class="active"><a href="#fish-health">Fish &amp; Health</a></li>
                            <li><a href="#water-quality">Water Quality</a></li>
                            <li><a href="#pond-management">Pond Management</a></li>
                            <li><a href="#feeding">Feeding Guide</a></li>
                            <li><a href="#weather">Weather Advisory</a></li>
                            <li><a href="#disease">Disease Prevention</a></li>
                        </ul>
                    </aside>

                    <!-- Quick Facts -->
                    <aside class="widget with-title" style="padding:20px; background:#f8f9fa; border-radius:10px; margin-bottom:30px;">
                        <h3 class="widget-title">Quick Facts</h3>
                        <div class="quick-stats">
                            <div class="stat-box">
                                <div class="stat-num">24–28°C</div>
                                <div class="stat-lbl">Ideal Temp</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-num">&gt;5</div>
                                <div class="stat-lbl">mg/L O₂</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-num">6.5–8</div>
                                <div class="stat-lbl">pH Range</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-num">3–4×</div>
                                <div class="stat-lbl">Daily Feeds</div>
                            </div>
                        </div>
                    </aside>

                    <!-- Help Banner -->
                    <aside class="widget widget-banner with-title">
                        <div class="ttm-col-bgcolor-yes ttm-bgcolor-darkgrey col-bg-img-seven ttm-col-bgimage-yes ttm-bg">
                            <div class="ttm-col-wrapper-bg-layer ttm-bg-layer">
                                <div class="ttm-col-wrapper-bg-layer-inner"></div>
                            </div>
                            <div class="layer-content text-center">
                                <div class="ttm-icon ttm-icon_element-onlytxt ttm-icon_element-style-round ttm-icon_element-color-skincolor ttm-icon_element-size-xl">
                                    <i class="fa fa-comments-o"></i>
                                </div>
                                <h3>Need Expert Help?</h3>
                                <div class="ttm-horizontal_sep width-100 margin_top20 margin_bottom20"></div>
                                <ul>
                                    <li><i class="fa fa-phone"></i> +234 800 ODIMZ FARM</li>
                                    <li><i class="fa fa-envelope"></i> advisory@odimzfarm.com</li>
                                </ul>
                                <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor" href="contact-us.php">Book Appointment</a>
                            </div>
                        </div>
                    </aside>

                </div>
                <!-- ===== SIDEBAR END ===== -->

                <!-- ===== MAIN CONTENT ===== -->
                <div class="col-lg-8 content-area">
                    <div class="ttm-service-single-content-area">

                        <!-- Hero Banner -->
                        <div class="advisory-hero">
                            <h2><i class="fa fa-leaf" style="color:#00d1ff;margin-right:10px;"></i>Odimz Farm Advisory Center</h2>
                            <p>Expert guidance on fish health, water quality, feeding practices, pond maintenance, disease prevention, and sustainable fish farming — all in one place.</p>
                            <div class="badge-strip">
                                <span><i class="fa fa-check-circle"></i> Evidence-Based</span>
                                <span><i class="fa fa-refresh"></i> Regularly Updated</span>
                                <span><i class="fa fa-users"></i> Expert Reviewed</span>
                                <span><i class="fa fa-globe"></i> Nigeria-Focused</span>
                            </div>
                        </div>

                        <div class="row">

                            <!-- ===== CARD 1: Fish & Health ===== -->
                            <div class="col-lg-6 col-md-6 mb-4" id="fish-health">
                                <div class="adv-card card h-100">
                                    <div class="card-header">
                                        <i class="fa fa-heartbeat"></i>
                                        <h5>Fish &amp; Health Advisory</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="problem-strip">
                                            <strong>⚠ Problem: Fish are not eating</strong>
                                        </div>
                                        <p><strong>Common symptoms:</strong></p>
                                        <ul class="tip-list">
                                            <li>Reduced or no food uptake</li>
                                            <li>Lethargy or hiding behaviour</li>
                                            <li>Visible spots, frayed fins or discolouration</li>
                                        </ul>
                                        <p><strong>Possible causes:</strong></p>
                                        <ul class="tip-list">
                                            <li>Poor water quality (ammonia, nitrite, low O₂)</li>
                                            <li>Incorrect temperature or sudden temperature swings</li>
                                            <li>Stress from overcrowding or handling</li>
                                        </ul>
                                        <div class="solution-strip">
                                            <strong>✔ Immediate action:</strong> Test water parameters, reduce feeding, isolate sick fish and consult a vet or extension officer.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ===== CARD 2: Water Quality ===== -->
                            <div class="col-lg-6 col-md-6 mb-4" id="water-quality">
                                <div class="adv-card card h-100">
                                    <div class="card-header">
                                        <i class="fa fa-tint"></i>
                                        <h5>Water Quality Advisory</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Key parameters &amp; recommended ranges:</strong></p>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered wq-table mb-0">
                                                <caption class="sr-only">Recommended water quality ranges for healthy fish farming</caption>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Parameter</th>
                                                        <th scope="col">Range</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Temperature</td>
                                                        <td>24 – 28 °C</td>
                                                        <td><span class="badge-ok">Optimal</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>pH</td>
                                                        <td>6.5 – 8.0</td>
                                                        <td><span class="badge-ok">Optimal</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dissolved O₂</td>
                                                        <td>&gt; 5 mg/L</td>
                                                        <td><span class="badge-ok">Optimal</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ammonia (NH₃)</td>
                                                        <td>&lt; 0.02 mg/L</td>
                                                        <td><span class="badge-warn">Monitor</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nitrite (NO₂)</td>
                                                        <td>&lt; 0.1 mg/L</td>
                                                        <td><span class="badge-warn">Monitor</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="solution-strip mt-3">
                                            <strong>✔ Tip:</strong> Test water every 2 days. Do a 20–30% water change immediately if ammonia exceeds safe limits.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ===== CARD 3: Pond Management ===== -->
                            <div class="col-lg-6 col-md-6 mb-4" id="pond-management">
                                <div class="adv-card card h-100">
                                    <div class="card-header">
                                        <i class="flaticon-pond-1"></i>
                                        <h5>Pond Management Tips</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Water Changes</strong></p>
                                        <ul class="tip-list">
                                            <li>Replace 10–20% of water weekly to dilute toxins</li>
                                            <li>Use dechlorinated or well-settled water</li>
                                        </ul>
                                        <p><strong>Pond Cleaning</strong></p>
                                        <ul class="tip-list">
                                            <li>Remove waste and sludge from the bottom regularly</li>
                                            <li>Disinfect pond between stocking cycles</li>
                                        </ul>
                                        <p><strong>Stocking Density</strong></p>
                                        <ul class="tip-list">
                                            <li>Catfish: 50–100 fish per m³ (earthen pond)</li>
                                            <li>Tilapia: 3–5 fish per m² (intensive system)</li>
                                        </ul>
                                        <p><strong>Aeration</strong></p>
                                        <ul class="tip-list">
                                            <li>Run aerators at night and during hot afternoons</li>
                                            <li>Low oxygen is the #1 cause of overnight fish death</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- ===== CARD 4: Weather Advisory ===== -->
                            <div class="col-lg-6 col-md-6 mb-4" id="weather">
                                <div class="adv-card card h-100">
                                    <div class="card-header">
                                        <i class="fa fa-cloud"></i>
                                        <h5>Weather Advisory</h5>
                                    </div>
                                    <div class="card-body">
                                        <span class="weather-badge weather-hot">☀ Hot &amp; Dry Weather</span>
                                        <ul class="tip-list mb-3">
                                            <li>High temperature lowers dissolved oxygen — increase aeration</li>
                                            <li>Reduce feeding during peak afternoon heat</li>
                                            <li>Shade large earthen ponds where possible</li>
                                        </ul>
                                        <span class="weather-badge weather-rain">🌧 Rainy Season</span>
                                        <ul class="tip-list mb-3">
                                            <li>Heavy rain lowers pH — monitor and add lime if needed</li>
                                            <li>Prevent runoff and flooding from entering the pond</li>
                                            <li>Increase oxygen monitoring after heavy downpours</li>
                                        </ul>
                                        <span class="weather-badge weather-dry">🌾 Harmattan / Dry Season</span>
                                        <ul class="tip-list">
                                            <li>Water levels drop — top up with clean water regularly</li>
                                            <li>Reduced oxygen as concentration increases — increase aeration</li>
                                            <li>Watch for sudden temperature drops at night</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- ===== CARD 5: Feeding Advisory (full width) ===== -->
                            <div class="col-12 mb-4" id="feeding">
                                <div class="adv-card card">
                                    <div class="card-header">
                                        <i class="fa fa-cutlery"></i>
                                        <h5>Feeding Advisory</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <p><strong>Feeding Guide by Fish Age</strong></p>
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered feed-table">
                                                        <caption class="sr-only">Recommended feeding guide based on fish age and growth stage</caption>
                                                        <thead>
                                                            <tr>
                                                                <th>Fish Age</th>
                                                                <th>Feed Type</th>
                                                                <th>Frequency</th>
                                                                <th>Daily Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>0 – 1 Month</td>
                                                                <td>Starter Feed (45–50% protein)</td>
                                                                <td>4–5× daily</td>
                                                                <td>10% body weight</td>
                                                            </tr>
                                                            <tr>
                                                                <td>1 – 3 Months</td>
                                                                <td>Grower Feed (35–40% protein)</td>
                                                                <td>3–4× daily</td>
                                                                <td>5–8% body weight</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3+ Months</td>
                                                                <td>Finisher Feed (28–32% protein)</td>
                                                                <td>2–3× daily</td>
                                                                <td>3–5% body weight</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="problem-strip">
                                                            <strong>⚠ Overfeeding Signs</strong>
                                                            <ul class="tip-list mt-2">
                                                                <li>Uneaten feed visible</li>
                                                                <li>Cloudy/dirty water</li>
                                                                <li>High ammonia spikes</li>
                                                                <li>Slow growth despite feeding</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="solution-strip">
                                                            <strong>✔ Underfeeding Signs</strong>
                                                            <ul class="tip-list mt-2">
                                                                <li>Slow or stunted growth</li>
                                                                <li>Fish crowding at surface</li>
                                                                <li>Aggressive fin-nipping</li>
                                                                <li>Thin body profile</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="problem-strip mt-2">
                                                    <strong>💡 Pro tip:</strong> Feed only what fish consume in 5–10 minutes. Remove any leftover feed immediately.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ===== CARD 6: Disease Prevention (full width) ===== -->
                            <div class="col-12 mb-4" id="disease">
                                <div class="adv-card card">
                                    <div class="card-header">
                                        <i class="fa fa-medkit"></i>
                                        <h5>Disease Prevention &amp; Early Detection</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p><strong>Common Diseases</strong></p>
                                                <ul class="tip-list">
                                                    <li>Columnaris (Saddle-back disease)</li>
                                                    <li>Aeromonas infection (Red sore disease)</li>
                                                    <li>Ich / White spot disease</li>
                                                    <li>Gill flukes &amp; parasites</li>
                                                    <li>Dropsy (bloating / pine-cone scales)</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <p><strong>Early Warning Signs</strong></p>
                                                <ul class="tip-list">
                                                    <li>Fish rubbing against walls or bottom</li>
                                                    <li>Gasping at the surface</li>
                                                    <li>Red or ulcerated patches on skin</li>
                                                    <li>Swollen belly or raised scales</li>
                                                    <li>Sudden unexplained mortality</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <p><strong>Prevention Practices</strong></p>
                                                <ul class="tip-list">
                                                    <li>Quarantine new fish for 2 weeks before introducing</li>
                                                    <li>Maintain proper stocking density</li>
                                                    <li>Disinfect nets and equipment between ponds</li>
                                                    <li>Keep water parameters stable and clean</li>
                                                    <li>Vaccinate or treat prophylactically as recommended</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="solution-strip mt-2">
                                            <strong>✔ When in doubt:</strong> Collect a sample of sick fish in a clean sealed bag with pond water and take to the nearest FADAMA or NAFDAC-registered fish health officer immediately.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /row of cards -->

                        <!-- CTA -->
                        <div class="adv-cta">
                            <h4><i class="fa fa-phone-square" style="color:#00d1ff;margin-right:8px;"></i>Get Personalised Advisory Support</h4>
                            <p>Our team of fish farming specialists is available to provide hands-on guidance tailored to your farm's specific needs — from pond design to harvest planning.</p>
                            <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-fill ttm-btn-color-skincolor" href="contact-us.php">
                                <i class="fa fa-calendar" style="margin-right:6px;"></i>Book a Free Consultation
                            </a>
                            &nbsp;&nbsp;
                            <a class="ttm-btn ttm-btn-size-md ttm-btn-shape-rounded ttm-btn-style-border ttm-btn-color-white" href="faq.php">
                                <i class="fa fa-question-circle" style="margin-right:6px;"></i>View FAQs
                            </a>
                        </div>

                    </div><!-- /ttm-service-single-content-area -->
                </div><!-- /col-lg-8 content-area -->

            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /ttm-row -->
</div><!-- /site-main -->

<?php include 'includes/lp-footer.php' ?>
