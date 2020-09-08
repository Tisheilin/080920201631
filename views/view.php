<div class="page_content bg_gray">
  <div class="uo_header">
    <div class="wrapper cf">
      <div class="wbox ava">
        <figure><img src="imgc/user_ava_1_140.jpg" alt="Helena Afrassiabi" /></figure>
      </div>
      <div class="main_info">
        <h1>Helena Afrassiabi</h1>
        <div class="midbox">
          <h4>560 points</h4>
          <div class="info_nav">
            <a href="#">Get Free Points</a>
            <span class="sepor"></span>
            <a href="#">Win iPad</a>
          </div>
        </div>
        <div class="stat">
          <div class="item">
            <div class="num">30</div>
            <div class="title">total orders</div>
          </div>
          <div class="item">
            <div class="num">14</div>
            <div class="title">total reviews</div>
          </div>
          <div class="item">
            <div class="num">0</div>
            <div class="title">total gifts</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="uo_body">
    <div class="wrapper">
      <div class="uofb cf">
        <div class="l_col adrs">
          <h2>Add New Address</h2>

          <form action="/create" method="post">
            <div class="field">
              <label>Name *</label>
              <input type="text" value="" placeholder="" class="vl_empty" name="name" required />
            </div>
            <div class="field">
              <label>Your city *</label>
              <select name = "city" class="vl_empty" required>
                <option class="plh"></option>
                <option value="Kiev">Kiev</option>
                <option value="Kharkiv">Kharkiv</option>
              </select>
            </div>
            <div class="field">
              <label>Your area *</label>
              <select name = "area" required>
                <option class="plh"></option>
                <option>Kievskaya</option>
                <option>Khar'kovskaya</option>
              </select>
            </div>

            <div class="field">
              <label>Street</label>
              <input type="text" value="" placeholder="" class="vl_empty" name = "street" />
            </div>
            <div class="field">
              <label>House # </label>
              <input type="text" value="" placeholder="House Name / Number" name = "house"/>
            </div>

            <div class="field">
              <label class="pos_top">Additional information</label>
              <textarea name = "information"></textarea>
            </div>

            <div class="field">
              <input type="submit" value="add address" class="green_btn" />
            </div>
          </form>
        </div>

        <div class="r_col">
          <h2>My Addresses</h2>

          <div class="uo_adr_list" id="addressList">

            <?php
            foreach ( $addressList as $address ) {
              $text = htmlentities($address['city']) . ', ' . htmlentities($address['area']);

              if ( $address['street'] ){
                $text = $text . ', ' .  htmlentities($address['street']);
              }
              if ( $address['house'] ){
                $text = $text . ', ' . htmlentities($address['house']);
              }
              ?>
              <div class="item">
                <h3><?= htmlentities($address['name']) ?></h3>
                <p><?= $text ?></p>
                <br>
                <?php if ( $address['information'] ){?>
                <p><?=htmlentities($address['information'])?></p>
                <?php } ?>
                <div class="map"></div>
                <div class="actbox">
                  <a href="#" onclick="remove(<?=$address['id']?>)" class="bcross"></a>
                </div>
              </div>

              <?php
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script defer src="/js/script.js"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAPS_API_KEY ?>&callback=initMap" type="text/javascript"></script>