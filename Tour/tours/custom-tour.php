<?php
include '../partials/__head.php';
include '../partials/__subhero.php';
require_once '../config/db.php';
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<main class="main">
  <section id="travel-destinations" class="travel-destinations section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8 mx-auto text-center">
          <h2>CREATE YOUR OWN TOUR</h2>
          <p class="mb-5">Design your perfect adventure tailored just for you. Whether you crave vibrant city life or peaceful nature escapes, we'll help you customize every detail to make your travel dreams come true.</p>
        </div>
      </div>

      <!-- FORM START -->
      <form action="custom-tour-handler.php" method="POST" onsubmit="return false;">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="destination-filters isotope-filters" data-aos="fade-up" data-aos-delay="200">
            <li data-filter="*" class="filter-active">All Provinces</li>
            <li data-filter=".filter-tropical">Tropical</li>
            <li data-filter=".filter-mountain">Alpine</li>
            <li data-filter=".filter-urban">Cityscapes</li>
            <li data-filter=".filter-heritage">Heritage</li>
            <li data-filter=".filter-coastal">Seaside</li>
          </ul>

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="300">

            <!-- Siem Reap -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-heritage">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Siem Reap" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/Angkorwat/angk.jpg" alt="Siem Reap" class="slide active" loading="lazy">
                  <img src="/assets/img/Angkorwat/vtdks123de2sjfz9av3h.webp" class="slide" loading="lazy">
                  <img src="/assets/img/Angkorwat/anksun.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag cultural">Cultural</span>
                    <div class="destination-info">
                      <h4>Siem Reap</h4>
                      <p>Gateway to the majestic Angkor temples, vibrant markets, and rich Khmer heritage.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 20 Tours</span>
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>
            <!-- Kampong Cham -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-heritage">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Kampong Cham" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/KampongCham.jpg" alt="Kampong Cham" class="slide active" loading="lazy">
                  <img src="/assets/img/City/kampongcham-1.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/kampongchamm.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag cultural">Cultural</span>
                    <div class="destination-info">
                      <h4>Kampong Cham</h4>
                      <p>Discover riverside charm, colonial architecture, and local life along the Mekong.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 12 Tours</span>
                        <!-- <span class="starting-price">From $85</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Kampong Speu -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-tropical">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Kampong Speu" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/KampongSpue.jpg" alt="Kampong Speu" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Kampong Speu1.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Kampongspue-knorngpsa.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag adventure">Mountain</span>
                    <div class="destination-info">
                      <h4>Kampong Speu</h4>
                      <p>Explore Phnom Aural’s rugged beauty and serene countryside adventures.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 8 Treks</span>
                        <!-- <span class="starting-price">From $95</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Kampong Thom -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-heritage">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Kampong Thom" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/kampong thoms.jpg" alt="Kampong Thom" class="slide active" loading="lazy">
                  <img src="/assets/img/City/kampongthom.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Kampong Thom1.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag nature">Eco-Venture</span>
                    <div class="destination-info">
                      <h4>Kampong Thom</h4>
                      <p>Discover ancient temples and scenic wetlands in the heart of Cambodia’s countryside.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 12 Expeditions</span>
                        <!-- <span class="starting-price">From $110</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>
            <!-- Kandal -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-tropical">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Kandal" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/kandalse.jpg" alt="Kandal" class="slide active" loading="lazy">
                  <img src="/assets/img/City/kandal.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/kandall.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag modern">Cosmopolitan</span>
                    <div class="destination-info">
                      <h4>Kandal</h4>
                      <p>Explore vibrant markets, serene riverside views, and authentic Khmer urban culture.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 8 Journeys</span>
                        <!-- <span class="starting-price">From $85</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Prey Veng -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-tropical">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Prey Veng" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Preyveng.jpg" alt="Prey Veng" class="slide active" loading="lazy">
                  <img src="/assets/img/City/1-preyveng.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/preyvengs.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag romantic">Enchanting</span>
                    <div class="destination-info">
                      <h4>Prey Veng</h4>
                      <p>Peaceful countryside, lotus-filled fields, and authentic Khmer traditions await.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 6 Getaways</span>
                        <!-- <span class="starting-price">From $75</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Takeo -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-heritage">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Takeo" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Takeo.jpg" alt="Takeo" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Takeo1.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Takeo2.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag heritage">Ancient Charm</span>
                    <div class="destination-info">
                      <h4>Takeo</h4>
                      <p>Discover Angkor-era temples, serene lakes, and Cambodia’s cradle of civilization.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 5 Adventures</span>
                        <!-- <span class="starting-price">From $65</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>
            <!-- Svay Rieng -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-tropical">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Svay Rieng" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Sangkat_Svay_Rieng,_Krong_Svay_Rieng,_Cambodia_-_panoramio.jpg" alt="Svay Rieng" class="slide active" loading="lazy">
                  <img src="/assets/img/City/svayrieng.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Svay-Rieng-5.webp" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag borderline">Hidden Gem</span>
                    <div class="destination-info">
                      <h4>Svay Rieng</h4>
                      <p>Explore tranquil rivers, quiet villages, and Cambodia’s vibrant border life.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 4 Escapes</span>
                        <!-- <span class="starting-price">From $60</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Pursat -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-heritage">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Pursat" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Pursat-Province-2.png" alt="Pursat" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Pursata.webp" class="slide" loading="lazy">
                  <img src="/assets/img/City/Pursat.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag nature">Nature Escape</span>
                    <div class="destination-info">
                      <h4>Pursat</h4>
                      <p>Journey through forested mountains, floating villages, and tranquil riversides.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 5 Retreats</span>
                        <!-- <span class="starting-price">From $68</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Battambang -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-urban">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Battambang" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/temple_hill_in_countryside_near_Battambang.jpg" alt="Battambang" class="slide active" loading="lazy">
                  <img src="/assets/img/City/battambang_phnom-banan-att-b.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Battambang.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag heritage">Cultural Charm</span>
                    <div class="destination-info">
                      <h4>Battambang</h4>
                      <p>Discover colonial architecture, creative arts, and the famous bamboo train adventure.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 7 Tours</span>
                        <!-- <span class="starting-price">From $72</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>
            <!-- Banteay Meanchey -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-heritage">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Banteay Meanchey" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Banteay Meanchey.jpg" alt="Banteay Meanchey" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Banteay Meancheyy.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Banteay Meancheyyyy.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag heritage">Historic Trails</span>
                    <div class="destination-info">
                      <h4>Banteay Meanchey</h4>
                      <p>Explore ancient temples, quiet countryside, and hidden stories near the Thai border.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 4 Sites</span>
                        <!-- <span class="starting-price">From $65</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Ratanakiri -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-mountain">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Ratanakiri" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Ratanakiri.jpg" alt="Ratanakiri" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Ratanakirir.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Ratanakirirr.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag nature">Wild & Scenic</span>
                    <div class="destination-info">
                      <h4>Ratanakiri</h4>
                      <p>Discover volcanic lakes, jungle waterfalls, and ethnic village life in Cambodia’s northeast frontier.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 5 Adventures</span>
                        <!-- <span class="starting-price">From $95</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Mondulkiri -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-mountain">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Mondulkiri" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Mondulkiri-2.jpg" alt="Mondulkiri" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Mondulkiri.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Mondulkirii.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag nature">Eco Escape</span>
                    <div class="destination-info">
                      <h4>Mondulkiri</h4>
                      <p>Home to rolling hills, elephant sanctuaries, and lush waterfalls — a true highland retreat.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 7 Eco Tours</span>
                        <!-- <span class="starting-price">From $89</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>
            <!-- Preah Vihear -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-heritage">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Preah Vihear" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Preah Vihears.jpg" alt="Preah Vihear" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Preah-Vihear-temple-1.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Preah-Vihear-2.webp" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag historical">Ancient Wonder</span>
                    <div class="destination-info">
                      <h4>Preah Vihear</h4>
                      <p>Explore the majestic cliff-top Preah Vihear Temple and scenic mountain landscapes.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 5 Heritage Trips</span>
                        <!-- <span class="starting-price">From $79</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Kratie -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-mountain">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Kratie" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Kratieee.jpg" alt="Kratie" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Kratiee.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Kratie.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag nature">River Escape</span>
                    <div class="destination-info">
                      <h4>Kratie</h4>
                      <p>Home of the rare Irrawaddy dolphins, Mekong sunsets, and serene river life.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 4 River Tours</span>
                        <!-- <span class="starting-price">From $65</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Oddar Meanchey -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-heritage">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Oddar Meanchey" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/oddor-meanchey-travel-guide.jpg" alt="Oddar Meanchey" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Oddar Meancheyy.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Oddar Meanchey.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag cultural">Sacred & Scenic</span>
                    <div class="destination-info">
                      <h4>Oddar Meanchey</h4>
                      <p>Explore untouched temples, mountain forests, and hidden eco-adventures in Cambodia’s northwest.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 3 Discoveries</span>
                        <!-- <span class="starting-price">From $69</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>
            <!-- Phnom Penh -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-urban">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Phnom Penh" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/inc.jpg" alt="Phnom Penh" class="slide active" loading="lazy">
                  <img src="/assets/img/City/ppp.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/royalpalace/royal-palace-1920x1200.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag urban">Vibrant Capital</span>
                    <div class="destination-info">
                      <h4>Phnom Penh</h4>
                      <p>Discover Cambodia’s energetic capital with royal landmarks, bustling markets, and riverside charm.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 12 Experiences</span>
                        <!-- <span class="starting-price">From $59</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Sihanoukville -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-coastal">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Sihanoukville" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Sihanoukvillees.jpg" alt="Sihanoukville" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Sihanoukvilles.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Sihanoukville.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag beach">Coastal City</span>
                    <div class="destination-info">
                      <h4>Sihanoukville</h4>
                      <p>Seaside escape with white-sand beaches, island getaways, and Cambodia’s main deep-sea port.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 8 Retreats</span>
                        <!-- <span class="starting-price">From $99</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Kep -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-coastal">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Kep" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/kep_has_been_selected_for_coastal_development._kep_administration.jpg" alt="Kep" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Kepp.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Kep.jpeg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Keps.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag chill">Seaside Escape</span>
                    <div class="destination-info">
                      <h4>Kep</h4>
                      <p>Charming coastal town famous for crab market, quiet beaches, and mountain views.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 4 Stays</span>
                        <!-- <span class="starting-price">From $65</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Kampot -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-coastal">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Kampot" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/kampot-roundabout-1024x683.jpg" alt="Kampot" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Farm_in_Kampot_province.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Kampots.jpg" class="slide" loading="lazy">

                  <div class="overlay-content">
                    <span class="destination-tag adventure">Nature & Heritage</span>
                    <div class="destination-info">
                      <h4>Kampot</h4>
                      <p>Scenic riverside town known for colonial charm, pepper farms, and Bokor Mountain.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 7 Retreats</span>
                        <!-- <span class="starting-price">From $70</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Koh Kong -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-coastal">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Koh Kong" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Koh Kong krao.jpg" alt="Koh Kong" class="slide active" loading="lazy">
                  <img src="/assets/img/City/Koh Kong.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Koh-Kong-Beach-01-380x395-1.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag nature">Rainforest & Coast</span>
                    <div class="destination-info">
                      <h4>Koh Kong</h4>
                      <p>Untouched province with rainforest, rivers, waterfalls, and remote beaches perfect for eco-tourism.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 5 Retreats</span>
                        <!-- <span class="starting-price">From $65</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Kampong Chhnang -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-tropical">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Kampong Chhnang" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/kampongchnang.jpg" alt="Kampong Chhnang" class="slide active" loading="lazy">
                  <img src="/assets/img/City/kampongchhnange.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Kampong-Chhnang-floating-village-3.jpg" class="slide" loading="lazy">
                  <div class="overlay-content">
                    <span class="destination-tag cultural">Cultural & River Life</span>
                    <div class="destination-info">
                      <h4>Kampong Chhnang</h4>
                      <p>Known for its traditional pottery, floating villages, and scenic riverside culture along the Tonlé Sap.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 4 Experiences</span>
                        <!-- <span class="starting-price">From $60</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Tboung Khmum -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-countryside">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Tboung Khmum" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/tbong kmum.jpg" alt="Tboung Khmum" class="slide active" loading="lazy">
                  <img src="/assets/img/City/tbongkmum.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/tbong kmum market.jpg" class="slide" loading="lazy">

                  <div class="overlay-content">
                    <span class="destination-tag countryside">Countryside & Local Life</span>
                    <div class="destination-info">
                      <h4>Tboung Khmum</h4>
                      <p>Peaceful province known for lush farmland, rubber plantations, and authentic rural culture.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 3 Journeys</span>
                        <!-- <span class="starting-price">From $55</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Pailin -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-mountain">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Pailin" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/pailin-mountains.jpg" alt="Pailin" class="slide active" loading="lazy">
                  <img src="/assets/img/City/pailinn.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/Pailin.jpg" class="slide" loading="lazy">

                  <div class="overlay-content">
                    <span class="destination-tag mountain">Mountain & Gem Land</span>
                    <div class="destination-info">
                      <h4>Pailin</h4>
                      <p>Mountainous area famous for gem mining, natural waterfalls, and quiet forest retreats.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 2 Escapes</span>
                        <!-- <span class="starting-price">From $60</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>
            <!-- Stung Treng -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-tropical">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Stung Treng" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/Stueng-Treng-5.webp" alt="Stung Treng" class="slide active" loading="lazy">
                  <img src="/assets/img/City/cambodia-stung-treng-thumbnail-01.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/stung-treng-scaled.jpeg" class="slide" loading="lazy">

                  <div class="overlay-content">
                    <span class="destination-tag river">River & Eco Retreat</span>
                    <div class="destination-info">
                      <h4>Stung Treng</h4>
                      <p>Tranquil riverside town at the confluence of the Mekong and Sekong Rivers, rich in eco-tourism and nature experiences.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 3 Retreats</span>
                        <!-- <span class="starting-price">From $65</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

            <!-- Casino -->
            <div class="col-lg-4 col-md-6 destination-item isotope-item filter-entertainment">
              <label class="destination-tile">
                <input type="checkbox" name="destinations[]" value="Casino" class="destination-checkbox">
                <div class="tile-image slider-fade">
                  <img src="/assets/img/City/luckyrb.webp" alt="Casino" class="slide active" loading="lazy">
                  <img src="/assets/img/City/nagaworld-hotel-entertainment.jpg" class="slide" loading="lazy">
                  <img src="/assets/img/City/luckyruby.jpg" class="slide" loading="lazy">


                  <div class="overlay-content">
                    <span class="destination-tag nightlife">Entertainment & Casino</span>
                    <div class="destination-info">
                      <h4>Casino</h4>
                      <p>Vibrant casino destinations with nightlife, luxury stays, and gaming experiences in Bavet, Poipet, and Sihanoukville.</p>
                      <div class="destination-stats">
                        <span class="tours-available"><i class="bi bi-map"></i> 5 Retreats</span>
                        <!-- <span class="starting-price">From $120</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>

          </div>
          <hr class="my-5">

          <div class="custom-tour-form mt-5">
            <h4 class="text-center mb-4">What's your preferred travel style?</h4>

            <?php
            $tourTypes = [];
            $accommodationTypes = [];

            $conn = new mysqli("localhost", "root", "", "jcytour-test");
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $tourTypeSql = "SELECT tour_type_id, tour_type FROM tour_type";
            $tourResult = $conn->query($tourTypeSql);
            if ($tourResult && $tourResult->num_rows > 0) {
              while ($row = $tourResult->fetch_assoc()) {
                $tourTypes[] = $row;
              }
            }

            $accomSql = "SELECT accommodation_type_id, accommodation_type FROM accommodation_type";
            $accomResult = $conn->query($accomSql);
            if ($accomResult && $accomResult->num_rows > 0) {
              while ($row = $accomResult->fetch_assoc()) {
                $accommodationTypes[] = $row;
              }
            }
            ?>
            <div class="row gy-3">
              <div class="col-md-6">
                <label class="form-label fw-bold">Select Tour Type</label>
                <select name="tour_type_id" class="form-select" required>
                  <option value="" disabled selected>Choose tour type</option>
                  <?php foreach ($tourTypes as $type): ?>
                    <option value="<?= $type['tour_type_id'] ?>"><?= htmlspecialchars($type['tour_type']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold">Select Accommodation Type</label>
                <select name="accommodation_type_id" class="form-select" required>
                  <option value="" disabled selected>Choose accommodation</option>
                  <?php foreach ($accommodationTypes as $type): ?>
                    <option value="<?= $type['accommodation_type_id'] ?>"><?= htmlspecialchars($type['accommodation_type']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>


              <div class="col-md-6">
                <label class="form-label d-block">Who will be traveling?</label>
                <div class="mb-2">
                  <label for="travelers_adults" class="form-label">Adults</label>
                  <input type="number" name="travelers_adults" id="travelers_adults" class="form-control" min="1" max="30" value="2" required>
                </div>
                <div>
                  <label for="travelers_children" class="form-label">Children</label>
                  <input type="number" name="travelers_children" id="travelers_children" class="form-control" min="0" max="20" value="0" required>
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label">How many hotel rooms?</label>
                <input type="number" name="hotel_rooms" id="hotel_rooms" class="form-control" min="1" max="20" value="2" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">When do you want to travel?</label>
                <input type="date" name="travel_date" class="form-control" id="travel_date" required placeholder="dd/mm/yyyy">
              </div>

              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  const today = new Date().toISOString().split('T')[0];
                  document.getElementById('travel_date').setAttribute('min', today);
                });
              </script>

              <div class="col-md-6">
                <label class="form-label">Desired trip length: <span id="tripDaysOutput">5</span> Days</label>
                <input type="range" name="trip_days" class="form-range" min="1" max="30" value="5" oninput="document.getElementById('tripDaysOutput').innerText = this.value">
              </div>

              <div class="col-md-6">
                <label class="form-label">Budget Per Person: <span id="budgetOutput">10000</span> USD</label>
                <input type="range" name="budget_per_person" class="form-range" min="100" max="20000" value="10000" step="100"
                  oninput="document.getElementById('budgetOutput').innerText = this.value">
              </div>

              <div class="col-md-12">
                <div class="form-check mt-3">
                  <input class="form-check-input" type="checkbox" name="flight_offer" value=" Yes" id="flight_offer" checked>
                  <label class="form-check-label" for="flight_offer">
                    Additionally, I am also interested in an international flight offer
                  </label>
                </div>
              </div>

              <div class="col-md-12 text-center mt-4">
                <button type="button" class="btn btn-primary px-5 py-2" onclick="handleContinue()">Continue</button>
              </div>

              <script>
                function handleContinue() {
                  const formData = {};

                  // Destinations
                  formData.destinations = Array.from(document.querySelectorAll('input[name="destinations[]"]:checked')).map(el => el.value);
                  if (formData.destinations.length === 0) {
                    return Swal.fire('Oops!', 'Please select at least one destination.', 'warning');
                  }

                  // Dropdowns
                  const tourType = document.querySelector('[name="tour_type_id"]');
                  const accomType = document.querySelector('[name="accommodation_type_id"]');
                  if (!tourType?.value || !accomType?.value) {
                    return Swal.fire('Missing Fields', 'Please select tour type and accommodation type.', 'warning');
                  }

                  formData.tour_type_id = tourType.value;
                  formData.accommodation_type_id = accomType.value;

                  // Required numeric inputs
                  const adults = document.querySelector('#travelers_adults');
                  const children = document.querySelector('#travelers_children');
                  const rooms = document.querySelector('#hotel_rooms');
                  const date = document.querySelector('#travel_date');

                  if (!adults?.value || !children?.value || !rooms?.value || !date?.value) {
                    return Swal.fire('Incomplete Form', 'Please fill in all traveler, room, and date fields.', 'warning');
                  }

                  formData.travelers_adults = parseInt(adults.value);
                  formData.travelers_children = parseInt(children.value);
                  formData.hotel_rooms = parseInt(rooms.value);
                  formData.travel_date = date.value;

                  // Optional sliders
                  const tripDaysEl = document.querySelector('input[name="trip_days"]');
                  const budgetEl = document.querySelector('input[name="budget_per_person"]');
                  const flightEl = document.querySelector('#flight_offer');

                  formData.trip_days = tripDaysEl ? parseInt(tripDaysEl.value) : null;
                  formData.budget_per_person = budgetEl ? parseFloat(budgetEl.value) : null;
                  formData.international_flight = flightEl?.checked ? 'Yes' : 'No';

                  // Save to localStorage
                  localStorage.setItem('custom_tour_info', JSON.stringify(formData));
                  localStorage.setItem('nextBookingPage', 'custom');

                  // Redirect to signup page
                  window.location.href = 'signup.php';
                }
              </script>

            </div>
          </div>
        </div>
        <input type="hidden" name="custom_tour_info_json" id="custom_tour_info_json">

      </form>
      <!-- FORM END -->
    </div>
  </section>
</main>

<style>
  .destination-checkbox {
    display: none;
  }

  .destination-tile {
    position: relative;
    display: block;
    cursor: pointer;
  }

  .tile-image::before {
    content: '';
    position: absolute;
    top: 15px;
    right: 15px;
    width: 22px;
    height: 22px;
    border: 2px solid #fff;
    background-color: rgba(255, 255, 255, 0.6);
    border-radius: 50%;
    z-index: 4;
    transition: all 0.3s ease;
  }

  .destination-checkbox:checked+.tile-image::before {
    content: '✓';
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
    font-size: 14px;
    text-align: center;
    line-height: 22px;
  }

  .destination-checkbox:checked+.tile-image {
    outline: 4px solid #0d6efd;
    border-radius: 12px;
    transition: 0.3s;
  }

  .overlay-content {
    position: absolute;
    bottom: 0;
    width: 100%;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    color: #fff;
    padding: 1rem;
    z-index: 3;
  }

  .slider-fade {
    position: relative;
    overflow: hidden;
    height: 250px;
  }

  .slider-fade img.slide {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    animation: slideFade 18s infinite;
    animation-timing-function: ease-in-out;
    transform-origin: center center;
  }

  .slider-fade img.slide:nth-child(1) {
    animation-delay: 0s;
  }

  .slider-fade img.slide:nth-child(2) {
    animation-delay: 6s;
  }

  .slider-fade img.slide:nth-child(3) {
    animation-delay: 12s;
  }

  @keyframes slideFade {
    0% {
      opacity: 0;
      transform: scale(1);
    }

    8% {
      opacity: 1;
      transform: scale(1.05);
    }

    33% {
      opacity: 1;
      transform: scale(1.05);
    }

    41% {
      opacity: 0;
      transform: scale(1);
    }

    100% {
      opacity: 0;
      transform: scale(1);
    }
  }
</style>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector('.booking-form');
    const hiddenInput = document.getElementById('custom_tour_info_json');

    form.addEventListener('submit', function(e) {
      const tourInfo = localStorage.getItem('custom_tour_info');
      if (!tourInfo) {
        alert("Tour information is missing. Please customize your tour first.");
        e.preventDefault(); // Stop submission
        return;
      }
      hiddenInput.value = tourInfo;
    });
  });
</script>


<div id="successModal" class="modal" style="display: none;">
  <div class="modal-content">
    <div style="text-align: center; padding: 30px;">
      <div style="font-size: 60px; color: green;">✔️</div>
      <h2 style="margin-top: 20px;">Success!</h2>
      <p>Your custom tour has been successfully booked.</p>
      <button onclick="closeSuccessModal()" style="background: #6c63ff; color: white; border: none; padding: 10px 20px; border-radius: 5px; margin-top: 20px;">OK</button>
    </div>
  </div>
</div>
<script>
  function getQueryParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  function closeSuccessModal() {
    document.getElementById("successModal").style.display = "none";
    // Optional: Remove ?booking=success from URL
    const url = new URL(window.location.href);
    url.searchParams.delete('booking');
    window.history.replaceState({}, document.title, url.pathname);
  }

  window.addEventListener('DOMContentLoaded', () => {
    if (getQueryParam('booking') === 'success') {
      document.getElementById("successModal").style.display = "flex";
    }
  });
</script>
<style>
  .modal {
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .modal-content {
    background: white;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  }
</style>

<?php include '../partials/_footer.php' ?>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<?php include '../partials/__footer.php'; ?>

<!-- Scripts -->
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="../assets/vendor/aos/aos.js"></script>
<script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="../assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/js/main.js"></script>

</body>

</html>