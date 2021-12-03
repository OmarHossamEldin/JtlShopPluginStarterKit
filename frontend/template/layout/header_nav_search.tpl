{block name='layout-header-nav-search-search' append}
    {* start floating button *}

    <button id='floatbutton'>
        <i class="fas fa-search" id='onlysmallscreen'></i>
        <span id='hoveronlyevent'>Bike Finder</span>
        <i class="fas fa-angle-down" id='onlylargscreen'></i>
    </button>

    {* end floating button *}
    <!-- start landing search -->
    <section class="landing-ser" id="landing-ser">

        <div class="par">
            <span id='closeonly'><i class="fas fa-times"></i></span>
            <div class="one">
                <form action="">
                    <label for="ser">Find your bike (manufacturer, model, year of construction)</label>
                    <span class="fack-form">
                        <input autofocus required type="text" id="ser" placeholder="search" autocomplete="off">
                        <i class="fas fa-search" id="close"></i>
                    </span>
                </form>

                <span id='resultCount' class='hid'></span>

                <div class="info" id="info">
                    <h2>All products for your bike</h2>

                    <p>Enter the manufacturer, model and year of manufacture and select your bike. So you only get perfectly
                        fitting products!</p>
                </div>




                <div class="search-res" id="search-res">

                </div>

                <button class="transfer-data">
                    SHOW MATCHING PRODUCTS
                </button>
            </div>

            <div class="two">
                <h2>Faster with an account</h2>

                <ul>
                    <li><i class="fas fa-check"></i> Save bikes permanently</li>
                    <li><i class="fas fa-check"></i> Put on different bikes</li>
                    <li><i class="fas fa-check"></i> Switch between models</li>
                </ul>

                <a href="" class="btn-1">register now</a>
            </div>

            <div class='there'></div>
        </div>
    </section>
    <!-- end landing search -->
{/block}
