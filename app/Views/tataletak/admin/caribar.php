<?php
helper('form');
?>
<div class="title-block">
                  <h3 class="title">
                    <?php echo form_open('','id="frm_filter" class="form-inline"'); ?>
                      <div class="form-group">
                        <label>Tahun </label>
                          <select class="form-control" id="src_tahun" name="src_tahun" onchange="this.form.submit()">
                            <option <?php if(isset($src_tahun) && $src_tahun == "2022") echo " selected " ?> value="2022">2022</option>            
                            <option <?php if(isset($src_tahun) && $src_tahun == "2021") echo " selected " ?> value="2021">2021</option>     
                            <option <?php if(isset($src_tahun) && $src_tahun == "2020") echo " selected " ?> value="2020">2020</option>   
                            <option <?php if(isset($src_tahun) && $src_tahun == "2017") echo " selected " ?> value="2017">2017</option>       
                          </select>
                       
                      </div>&nbsp;&nbsp; 
                      <div class="form-group">
                        <label>Sebagai </label>
                        
                          <select class="form-control" id="src_ybs" name="src_ybs" onchange="this.form.submit()">
                             <option  <?php if(isset($src_ybs) && $src_ybs == "1") echo " selected " ?>  value="1">yang bersangkutan</option>
                             <option  <?php if(isset($src_ybs) && $src_ybs == "0") echo " selected " ?>  value="0">penilai bawahan</option>
                           <!--   <option  <?php if(isset($src_ybs) && $src_ybs == "2") echo " selected " ?>  value="2">penilai setingkat</option>         -->                  
                           </select>
                        
                      </div>
                    </form>
                      </h3>
</div>