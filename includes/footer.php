  <!-- FOOTER -->
  <footer>
    <div class="foot-top">
      <div>
        <span class="foot-logo">
          <img src="<?php echo SITE_URL; ?>/img/new-familytreeindia-logo.svg" alt="Family Tree" class="logo-img">
        </span>
        <p class="foot-desc">Building permanent green cover through schools and communities. Every tree has a name.
          Every guardian has a story.</p>
        <div class="foot-soc">
          <?php if(!empty($site['facebook_url'])): ?>
          <a href="<?php echo $site['facebook_url']; ?>" class="fsoc" target="_blank" aria-label="Facebook">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <?php endif; ?>
          <?php if(!empty($site['instagram_url'])): ?>
          <a href="<?php echo $site['instagram_url']; ?>" class="fsoc" target="_blank" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <?php endif; ?>
          <?php if(!empty($site['linkedin_url'])): ?>
          <a href="<?php echo $site['linkedin_url']; ?>" class="fsoc" target="_blank" aria-label="LinkedIn">
            <i class="fa-brands fa-linkedin-in"></i>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <nav class="foot-col" aria-label="Organization links">
        <h5>Organisation</h5>
        <ul>
          <li><a href="<?php echo SITE_URL; ?>/about">About Us</a></li>
          <li><a href="<?php echo SITE_URL; ?>/about">Our Story</a></li>
          <li><a href="<?php echo SITE_URL; ?>/about">Leadership</a></li>
          <li><a href="<?php echo SITE_URL; ?>/about">Annual Reports</a></li>
        </ul>
      </nav>
      <nav class="foot-col" aria-label="Program links">
        <h5>Programs</h5>
        <ul>
          <li><a href="<?php echo SITE_URL; ?>/corporate">School Plantation</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Community Greening</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Urban Greening</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Carbon Projects</a></li>
        </ul>
      </nav>
      <nav class="foot-col" aria-label="Involvement links">
        <h5>Get Involved</h5>
        <ul>
          <li><a href="#" class="btn-donate" data-donation-source="footer_donate">Donate</a></li>
          <li><a href="mailto:<?php echo $site['contact_email']; ?>">Volunteer</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Corporate CSR</a></li>
          <li><a href="<?php echo SITE_URL; ?>/corporate">Partner With Us</a></li>
          <li><a href="mailto:<?php echo $site['contact_email']; ?>">Media & Press</a></li>
        </ul>
      </nav>
    </div>
    <div class="foot-btm">
      <span class="foot-copy">© <?php echo date('Y'); ?> Family Tree. Registered under Section 8. 80G Certified. FCRA Registered.</span>
      <div class="foot-legal">
        <a href="<?php echo SITE_URL; ?>/privacy">Privacy Policy</a>
        <a href="<?php echo SITE_URL; ?>/terms">Terms of Service</a>
        <a href="<?php echo SITE_URL; ?>/corporate">80G Certified</a>
        <a href="<?php echo SITE_URL; ?>/corporate">FCRA Registered</a>
      </div>
    </div>
  </footer>


  <!-- DONATION MODAL -->
  <div id="donateModal" class="modal">
    <div class="modal-content">
      <button class="modal-close" id="closeDonate">&times;</button>
        <div class="modal-header">
        <h2>Make a Donation</h2>
        <p>Your support helps us plant and care for more trees with student guardians.</p>
      </div>
      <form id="donateForm" class="cont-form">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" name="billing_name" placeholder="Full name" required>
        </div>
        <div class="form-group">
          <label>Address</label>
          <textarea name="billing_address" rows="3" placeholder="Billing address" required></textarea>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Mobile Number</label>
            <div class="phone-field">
              <select name="billing_country_code" id="billingCountryCode" aria-label="Country code" required>
                <option value="+93">🇦🇫 +93</option>
                <option value="+355">🇦🇱 +355</option>
                <option value="+213">🇩🇿 +213</option>
                <option value="+1-684">🇦🇸 +1-684</option>
                <option value="+376">🇦🇩 +376</option>
                <option value="+244">🇦🇴 +244</option>
                <option value="+1-264">🇦🇮 +1-264</option>
                <option value="+672">🇦🇶 +672</option>
                <option value="+1-268">🇦🇬 +1-268</option>
                <option value="+54">🇦🇷 +54</option>
                <option value="+374">🇦🇲 +374</option>
                <option value="+297">🇦🇼 +297</option>
                <option value="+61">🇦🇺 +61</option>
                <option value="+43">🇦🇹 +43</option>
                <option value="+994">🇦🇿 +994</option>
                <option value="+1-242">🇧🇸 +1-242</option>
                <option value="+973">🇧🇭 +973</option>
                <option value="+880">🇧🇩 +880</option>
                <option value="+1-246">🇧🇧 +1-246</option>
                <option value="+375">🇧🇾 +375</option>
                <option value="+32">🇧🇪 +32</option>
                <option value="+501">🇧🇿 +501</option>
                <option value="+229">🇧🇯 +229</option>
                <option value="+1-441">🇧🇲 +1-441</option>
                <option value="+975">🇧🇹 +975</option>
                <option value="+591">🇧🇴 +591</option>
                <option value="+387">🇧🇦 +387</option>
                <option value="+267">🇧🇼 +267</option>
                <option value="+55">🇧🇷 +55</option>
                <option value="+246">🇮🇴 +246</option>
                <option value="+1-284">🇻🇬 +1-284</option>
                <option value="+673">🇧🇳 +673</option>
                <option value="+359">🇧🇬 +359</option>
                <option value="+226">🇧🇫 +226</option>
                <option value="+257">🇧🇮 +257</option>
                <option value="+855">🇰🇭 +855</option>
                <option value="+237">🇨🇲 +237</option>
                <option value="+1">🇨🇦 +1</option>
                <option value="+238">🇨🇻 +238</option>
                <option value="+1-345">🇰🇾 +1-345</option>
                <option value="+236">🇨🇫 +236</option>
                <option value="+235">🇹🇩 +235</option>
                <option value="+56">🇨🇱 +56</option>
                <option value="+86">🇨🇳 +86</option>
                <option value="+61">🇨🇽 +61</option>
                <option value="+61">🇨🇨 +61</option>
                <option value="+57">🇨🇴 +57</option>
                <option value="+269">🇰🇲 +269</option>
                <option value="+682">🇨🇰 +682</option>
                <option value="+506">🇨🇷 +506</option>
                <option value="+385">🇭🇷 +385</option>
                <option value="+53">🇨🇺 +53</option>
                <option value="+599">🇨🇼 +599</option>
                <option value="+357">🇨🇾 +357</option>
                <option value="+420">🇨🇿 +420</option>
                <option value="+243">🇨🇩 +243</option>
                <option value="+45">🇩🇰 +45</option>
                <option value="+253">🇩🇯 +253</option>
                <option value="+1-767">🇩🇲 +1-767</option>
                <option value="+1-809">🇩🇴 +1-809</option>
                <option value="+670">🇹🇱 +670</option>
                <option value="+593">🇪🇨 +593</option>
                <option value="+20">🇪🇬 +20</option>
                <option value="+503">🇸🇻 +503</option>
                <option value="+240">🇬🇶 +240</option>
                <option value="+291">🇪🇷 +291</option>
                <option value="+372">🇪🇪 +372</option>
                <option value="+251">🇪🇹 +251</option>
                <option value="+500">🇫🇰 +500</option>
                <option value="+298">🇫🇴 +298</option>
                <option value="+679">🇫🇯 +679</option>
                <option value="+358">🇫🇮 +358</option>
                <option value="+33">🇫🇷 +33</option>
                <option value="+689">🇵🇫 +689</option>
                <option value="+241">🇬🇦 +241</option>
                <option value="+220">🇬🇲 +220</option>
                <option value="+995">🇬🇪 +995</option>
                <option value="+49">🇩🇪 +49</option>
                <option value="+233">🇬🇭 +233</option>
                <option value="+350">🇬🇮 +350</option>
                <option value="+30">🇬🇷 +30</option>
                <option value="+299">🇬🇱 +299</option>
                <option value="+1-473">🇬🇩 +1-473</option>
                <option value="+1-671">🇬🇺 +1-671</option>
                <option value="+502">🇬🇹 +502</option>
                <option value="+44-1481">🇬🇬 +44-1481</option>
                <option value="+224">🇬🇳 +224</option>
                <option value="+245">🇬🇼 +245</option>
                <option value="+592">🇬🇾 +592</option>
                <option value="+509">🇭🇹 +509</option>
                <option value="+504">🇭🇳 +504</option>
                <option value="+852">🇭🇰 +852</option>
                <option value="+36">🇭🇺 +36</option>
                <option value="+354">🇮🇸 +354</option>
                <option value="+91" selected>🇮🇳 +91</option>
                <option value="+62">🇮🇩 +62</option>
                <option value="+98">🇮🇷 +98</option>
                <option value="+964">🇮🇶 +964</option>
                <option value="+353">🇮🇪 +353</option>
                <option value="+44-1624">🇮🇲 +44-1624</option>
                <option value="+972">🇮🇱 +972</option>
                <option value="+39">🇮🇹 +39</option>
                <option value="+225">🇨🇮 +225</option>
                <option value="+1-876">🇯🇲 +1-876</option>
                <option value="+81">🇯🇵 +81</option>
                <option value="+44-1534">🇯🇪 +44-1534</option>
                <option value="+962">🇯🇴 +962</option>
                <option value="+7">🇰🇿 +7</option>
                <option value="+254">🇰🇪 +254</option>
                <option value="+686">🇰🇮 +686</option>
                <option value="+383">🇽🇰 +383</option>
                <option value="+965">🇰🇼 +965</option>
                <option value="+996">🇰🇬 +996</option>
                <option value="+856">🇱🇦 +856</option>
                <option value="+371">🇱🇻 +371</option>
                <option value="+961">🇱🇧 +961</option>
                <option value="+266">🇱🇸 +266</option>
                <option value="+231">🇱🇷 +231</option>
                <option value="+218">🇱🇾 +218</option>
                <option value="+423">🇱🇮 +423</option>
                <option value="+370">🇱🇹 +370</option>
                <option value="+352">🇱🇺 +352</option>
                <option value="+853">🇲🇴 +853</option>
                <option value="+389">🇲🇰 +389</option>
                <option value="+261">🇲🇬 +261</option>
                <option value="+265">🇲🇼 +265</option>
                <option value="+60">🇲🇾 +60</option>
                <option value="+960">🇲🇻 +960</option>
                <option value="+223">🇲🇱 +223</option>
                <option value="+356">🇲🇹 +356</option>
                <option value="+692">🇲🇭 +692</option>
                <option value="+222">🇲🇷 +222</option>
                <option value="+230">🇲🇺 +230</option>
                <option value="+262">🇾🇹 +262</option>
                <option value="+52">🇲🇽 +52</option>
                <option value="+691">🇫🇲 +691</option>
                <option value="+373">🇲🇩 +373</option>
                <option value="+377">🇲🇨 +377</option>
                <option value="+976">🇲🇳 +976</option>
                <option value="+382">🇲🇪 +382</option>
                <option value="+1-664">🇲🇸 +1-664</option>
                <option value="+212">🇲🇦 +212</option>
                <option value="+258">🇲🇿 +258</option>
                <option value="+95">🇲🇲 +95</option>
                <option value="+264">🇳🇦 +264</option>
                <option value="+674">🇳🇷 +674</option>
                <option value="+977">🇳🇵 +977</option>
                <option value="+31">🇳🇱 +31</option>
                <option value="+599">🇧🇶 +599</option>
                <option value="+687">🇳🇨 +687</option>
                <option value="+64">🇳🇿 +64</option>
                <option value="+505">🇳🇮 +505</option>
                <option value="+227">🇳🇪 +227</option>
                <option value="+234">🇳🇬 +234</option>
                <option value="+683">🇳🇺 +683</option>
                <option value="+850">🇰🇵 +850</option>
                <option value="+1-670">🇲🇵 +1-670</option>
                <option value="+47">🇳🇴 +47</option>
                <option value="+968">🇴🇲 +968</option>
                <option value="+92">🇵🇰 +92</option>
                <option value="+680">🇵🇼 +680</option>
                <option value="+970">🇵🇸 +970</option>
                <option value="+507">🇵🇦 +507</option>
                <option value="+675">🇵🇬 +675</option>
                <option value="+595">🇵🇾 +595</option>
                <option value="+51">🇵🇪 +51</option>
                <option value="+63">🇵🇭 +63</option>
                <option value="+64">🇵🇳 +64</option>
                <option value="+48">🇵🇱 +48</option>
                <option value="+351">🇵🇹 +351</option>
                <option value="+1-787">🇵🇷 +1-787</option>
                <option value="+974">🇶🇦 +974</option>
                <option value="+242">🇨🇬 +242</option>
                <option value="+262">🇷🇪 +262</option>
                <option value="+40">🇷🇴 +40</option>
                <option value="+7">🇷🇺 +7</option>
                <option value="+250">🇷🇼 +250</option>
                <option value="+590">🇧🇱 +590</option>
                <option value="+290">🇸🇭 +290</option>
                <option value="+1-869">🇰🇳 +1-869</option>
                <option value="+1-758">🇱🇨 +1-758</option>
                <option value="+590">🇲🇫 +590</option>
                <option value="+508">🇵🇲 +508</option>
                <option value="+1-784">🇻🇨 +1-784</option>
                <option value="+685">🇼🇸 +685</option>
                <option value="+378">🇸🇲 +378</option>
                <option value="+239">🇸🇹 +239</option>
                <option value="+966">🇸🇦 +966</option>
                <option value="+221">🇸🇳 +221</option>
                <option value="+381">🇷🇸 +381</option>
                <option value="+248">🇸🇨 +248</option>
                <option value="+232">🇸🇱 +232</option>
                <option value="+65">🇸🇬 +65</option>
                <option value="+1-721">🇸🇽 +1-721</option>
                <option value="+421">🇸🇰 +421</option>
                <option value="+386">🇸🇮 +386</option>
                <option value="+677">🇸🇧 +677</option>
                <option value="+252">🇸🇴 +252</option>
                <option value="+27">🇿🇦 +27</option>
                <option value="+82">🇰🇷 +82</option>
                <option value="+211">🇸🇸 +211</option>
                <option value="+34">🇪🇸 +34</option>
                <option value="+94">🇱🇰 +94</option>
                <option value="+249">🇸🇩 +249</option>
                <option value="+597">🇸🇷 +597</option>
                <option value="+47">🇸🇯 +47</option>
                <option value="+268">🇸🇿 +268</option>
                <option value="+46">🇸🇪 +46</option>
                <option value="+41">🇨🇭 +41</option>
                <option value="+963">🇸🇾 +963</option>
                <option value="+886">🇹🇼 +886</option>
                <option value="+992">🇹🇯 +992</option>
                <option value="+255">🇹🇿 +255</option>
                <option value="+66">🇹🇭 +66</option>
                <option value="+228">🇹🇬 +228</option>
                <option value="+690">🇹🇰 +690</option>
                <option value="+676">🇹🇴 +676</option>
                <option value="+1-868">🇹🇹 +1-868</option>
                <option value="+216">🇹🇳 +216</option>
                <option value="+90">🇹🇷 +90</option>
                <option value="+993">🇹🇲 +993</option>
                <option value="+1-649">🇹🇨 +1-649</option>
                <option value="+688">🇹🇻 +688</option>
                <option value="+1-340">🇻🇮 +1-340</option>
                <option value="+256">🇺🇬 +256</option>
                <option value="+380">🇺🇦 +380</option>
                <option value="+971">🇦🇪 +971</option>
                <option value="+44">🇬🇧 +44</option>
                <option value="+1">🇺🇸 +1</option>
                <option value="+598">🇺🇾 +598</option>
                <option value="+998">🇺🇿 +998</option>
                <option value="+678">🇻🇺 +678</option>
                <option value="+379">🇻🇦 +379</option>
                <option value="+58">🇻🇪 +58</option>
                <option value="+84">🇻🇳 +84</option>
                <option value="+681">🇼🇫 +681</option>
                <option value="+212">🇪🇭 +212</option>
                <option value="+967">🇾🇪 +967</option>
                <option value="+260">🇿🇲 +260</option>
                <option value="+263">🇿🇼 +263</option>
              </select>
              <input type="tel" name="billing_phone_number" id="billingPhoneNumber" placeholder="XXXXX XXXXX" inputmode="numeric" maxlength="10" pattern="[0-9]{10}" required>
            </div>
            <input type="hidden" name="billing_mobile" id="billingMobileFull" value="">
          </div>
          <div class="form-group">
            <label>Amount (INR)</label>
            <input type="number" name="amount" placeholder="1000" min="1" step="1" required>
          </div>
        </div>
        <input type="hidden" name="source" value="donation_popup">
        <button type="submit" class="btn-y" style="width: 100%;">Proceed to Payment</button>
        <div id="donateFeedback" style="margin-top: 15px; font-size: 0.9rem; padding: 12px; border-radius: 6px; display: none;"></div>
      </form>
    </div>
  </div>

  <style>
    .modal { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background: rgba(10, 25, 12, 0.5); backdrop-filter: blur(3px); align-items: center; justify-content: center; padding: 20px; }
    .modal.active { display: flex; }
    .modal-content { background: #fff; width: 100%; max-width: 580px; padding: 48px 40px; border-radius: 24px; position: relative; max-height: 90vh; overflow-y: auto; box-shadow: 0 32px 64px rgba(0,0,0,0.4); }
    .modal-close { position: absolute; right: 24px; top: 24px; background: rgba(0,0,0,0.05); border: none; font-size: 1.2rem; cursor: pointer; color: #000; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: 0.3s; z-index: 10; }
    .modal-close:hover { background: rgba(0,0,0,0.1); transform: rotate(90deg); }
    .modal-header { margin-bottom: 28px; text-align: center; }
    .modal-header h2 { font-family: 'Fraunces', serif; font-size: 2.2rem; font-weight: 900; margin-bottom: 8px; color: #0f2310; letter-spacing: -0.02em; }
    .modal-header p { color: rgba(0,0,0,0.5); font-size: 0.95rem; line-height: 1.5; max-width: 400px; margin: 0 auto; }
    
    /* FORM STYLES */
    .modal .cont-form { gap: 16px !important; }
    .modal .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 0; }
    .modal .form-group { margin-bottom: 0; display: flex; flex-direction: column; gap: 6px; }
    .modal .form-group label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #0f2310; opacity: 0.5; }
    .modal .form-group input, 
    .modal .form-group select, 
    .modal .form-group textarea { width: 100%; padding: 12px 16px; border: 1.5px solid rgba(0,0,0,0.08); border-radius: 10px; font-family: inherit; font-size: 0.95rem; background: #f9f9f9; transition: all 0.3s; color: #000; }
    .modal .form-group input:focus, 
    .modal .form-group select:focus, 
    .modal .form-group textarea:focus { outline: none; border-color: #2d6b35; background: #fff; box-shadow: 0 0 0 4px rgba(45, 107, 53, 0.1); }
    .modal .phone-field { display: grid; grid-template-columns: 116px 1fr; gap: 8px; }
    .modal .phone-field select { padding-left: 10px; padding-right: 8px; }
    .modal .phone-field input { min-width: 0; }
    .modal .btn-y { background: #f0c132; color: #000; border: none; padding: 16px; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: 0.3s; margin-top: 8px; }
    .modal .btn-y:hover { background: #e0b020; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(240, 193, 50, 0.3); }

    @media (max-width: 600px) {
      .modal-content { padding: 36px 20px; border-radius: 16px; }
      .modal-header h2 { font-size: 1.8rem; }
      .modal-header p { font-size: 0.88rem; }
      .modal .form-row { grid-template-columns: 1fr; gap: 16px; }
      .modal .phone-field { grid-template-columns: 110px 1fr; }
    }
  </style>

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script src="<?php echo SITE_URL; ?>/js/script.js"></script>
  <?php if(isset($extraJS)): foreach($extraJS as $js): ?>
  <?php if(strpos($js, 'http') === 0): ?>
  <script src="<?php echo $js; ?>"></script>
  <?php else: ?>
  <script src="<?php echo SITE_URL; ?>/js/<?php echo $js; ?>"></script>
  <?php endif; ?>
  <?php endforeach; endif; ?>
</body>
</html>
