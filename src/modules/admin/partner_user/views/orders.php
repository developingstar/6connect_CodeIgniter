<div id="rightView" ng-hide="$state.current.name === 'partner_user.orders'">
     <div ui-view></div>
</div>
<div class="content">
     <div  animate-panel>
          <div class="row" ng-controller="porderCtrl" ng-show="$state.current.name === 'partner_user.orders'">
               <div class="col-lg-12">
                    <div class="hpanel">                        
                         <div class="panel-body">                            
                              <div class="col-lg-12 no-padding margin_bottom_10 search_toolbar">
                                   <div class="pull-left">
                                        <div  class="dataTables_length">
                                             <label>
                                                  Show
                                                  <select class="form-control"  name="perpage" ng-model="orderslistdata.perpage"  
                                                          ng-options="ordersperpages as ordersperpages.label for ordersperpages in ordersperpage" ng-change="perpagechange()">
                                                       <option style="display:none" value class>15</option>
                                                  </select>
                                                  entries
                                             </label>
                                        </div>
                                   </div>

                                   <div class="pull-right no-padding">
                                        <div class="table_filter"  style="display: inline-flex;">
                                             <input ng-change="findorders()" aria-controls="order_list"  class="form-control input-sm" type="search" ng-model="orderslistdata.filter" placeholder="<?= lang('search_label') ?>">
                                        </div>                                     
                                        <div class="table_filter"  style="display: inline-flex;">
                                             <select class="form-control input-sm" name="perpage" ng-model="orderslistdata.status" ng-change="findorders()">
                                                  <option value="all">All Statuses</option>
                                                  <option ng-repeat="stat in filter_statuslist" value="{{stat.status_id}}">{{stat.display_name}}</option>
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="clr"></div>
                              <div class="table-responsive">
                                   <table id="order_list" class="table table-striped table-bordered table-responsive">
                                        <thead>
                                             <tr>
                                                  <th style="width:10%;"><?= lang('order_tracking_id') ?>
                                                       <i ng-class="{'glyphicon glyphicon-sort':orderheaders.public_id.reverse == undefined, 'glyphicon glyphicon-sort-by-attributes-alt': orderheaders.public_id.reverse == true, 'glyphicon glyphicon-sort-by-attributes': orderheaders.public_id.reverse == false}" class="pull-right" ng-click="sort('public_id')"></i>  
                                                  </th>
                                                  <th style="width:10%;"><?= lang('order_assigned_id') ?>
                                                       <i ng-class="{'glyphicon glyphicon-sort':orderheaders.private_id.reverse == undefined, 'glyphicon glyphicon-sort-by-attributes-alt': orderheaders.private_id.reverse == true, 'glyphicon glyphicon-sort-by-attributes': orderheaders.private_id.reverse == false}" class="pull-right" ng-click="sort('private_id')"></i>  
                                                  </th>
                                                  <th style="width:10%;"><?= lang('orders_table_services') ?>
                                                       <i ng-class="{'glyphicon glyphicon-sort':orderheaders.service.reverse == undefined, 'glyphicon glyphicon-sort-by-attributes-alt': orderheaders.service.reverse == true, 'glyphicon glyphicon-sort-by-attributes': orderheaders.service.reverse == false}" class="pull-right" ng-click="sort('service')"></i>  
                                                  </th>
                                                  <th style="width:20%;"><?= lang('orders_table_collection') ?>
                                                       <i ng-class="{'glyphicon glyphicon-sort':orderheaders.collection_address.reverse == undefined, 'glyphicon glyphicon-sort-by-attributes-alt': orderheaders.collection_address.reverse == true, 'glyphicon glyphicon-sort-by-attributes': orderheaders.collection_address.reverse == false}" class="pull-right" ng-click="sort('collection_address')"></i>  
                                                  </th>
                                                  <th style="width:20%;"><?= lang('orders_table_delivery') ?>
                                                       <i ng-class="{'glyphicon glyphicon-sort':orderheaders.delivery_address.reverse == undefined, 'glyphicon glyphicon-sort-by-attributes-alt': orderheaders.delivery_address.reverse == true, 'glyphicon glyphicon-sort-by-attributes': orderheaders.delivery_address.reverse == false}" class="pull-right" ng-click="sort('delivery_address')"></i>  
                                                  </th>
                                                  <th style="width:20%;"><?= lang('orders_table_username') ?>
                                                       <i ng-class="{'glyphicon glyphicon-sort':orderheaders.username.reverse == undefined, 'glyphicon glyphicon-sort-by-attributes-alt': orderheaders.username.reverse == true, 'glyphicon glyphicon-sort-by-attributes': orderheaders.username.reverse == false}" class="pull-right" ng-click="sort('username')"></i>  
                                                  </th>
                                                  <th style="width:10%;"><?= lang('orders_table_status') ?>
                                                       <i ng-class="{'glyphicon glyphicon-sort':orderheaders.status.reverse == undefined, 'glyphicon glyphicon-sort-by-attributes-alt': orderheaders.status.reverse == true, 'glyphicon glyphicon-sort-by-attributes': orderheaders.status.reverse == false}" class="pull-right" ng-click="sort('status')"></i>   
                                                  </th>
                                                  <th style="width:10%;" ng-if="!org_id"><?= lang('orders_table_organisation') ?>
                                                       <i ng-class="{'glyphicon glyphicon-sort':orderheaders.org_name.reverse == undefined, 'glyphicon glyphicon-sort-by-attributes-alt': orderheaders.org_name.reverse == true, 'glyphicon glyphicon-sort-by-attributes': orderheaders.org_name.reverse == false}" class="pull-right" ng-click="sort('org_name')"></i>  
                                                  </th>
                                                  <th style="width:10%;"><?= lang('action') ?></th>
                                             </tr>
                                        </thead>
                                        <tbody id="orderslist_body">
                                             <tr ng-repeat="order in orderslist|orderBy:orderByField:reverseSort">
                                                  <td>                                                     
                                                       <span>
                                                            <a ui-sref="partner_user.orders.view_order({order_id:order.public_id})" class="link_color"> {{order.public_id}}</a>
                                                       </span>
                                                  </td>
                                                  <td> {{order.private_id}}</td>
                                                  <td>{{order.service}}
                                                       <span ng-if="order.courier_id">
                                                            <span ng-click="view_courier_info(order.courier_id)" class="courier_name">{{order.courier_name}}</span>
                                                       </span>      
                                                  </td>
                                                  <td>
                                                       {{order.collection_contact_name}}<br>
                                                       {{order.collection_address}}<br>
                                                       {{order.from_country}}<br>
                                                       {{order.collection_contact_number}}
                                                       <span ng-if="order.crestrict !=0" class="row_icon" title="<?= lang('restricted_area_tooltip') ?>"><i class="fa fa-ban"></i></span>
                                                  </td>
                                                  <td>
                                                       {{order.delivery_contact_name}}<br>
                                                       {{order.delivery_address}}<br>
                                                       {{order.to_country}}<br>
                                                       {{order.delivery_contact_phone}}
                                                       <span ng-if="order.drestrict !=0" class="row_icon" title="<?= lang('restricted_area_tooltip') ?>"><i class="fa fa-ban"></i></span>
                                                  </td>
                                                  <td>{{order.username}}</td>
                                                  <td>{{order.status}}</td>
                                                  <td>{{order.org_name|| "-"}}</td>
                                                  <td>                                                      
                                                       <a ng-href="<?php echo site_url('orders/printOrder') . '/'; ?>{{order.consignment_id}}" title="<?= lang('print_btn') ?>" ng-if="order.is_for_bidding == 0 || order.is_confirmed == 1">
                                                            <i class="fa fa-print"></i> 
                                                       </a>
                                                  </td>
                                             </tr>

                                             <tr class="no-data">
                                                  <td colspan="9"><?= lang('nothing_to_display') ?></td>
                                             </tr>
                                        </tbody>
                                        <tbody id="orders_loading" class="loading">
                                             <tr>                                                  
                                                  <td colspan="9" class="text-center">
                                                       <img src="<?php echo base_url(); ?>resource/images/loading-bars.svg" width="36" height="36" alt="<?= lang('loading') ?>">
                                                  </td>
                                             </tr>
                                        </tbody>
                                   </table>
                              </div>
                              <div class="col-md-12 no-padding">
                                   <div class="col-md-4 no-padding">
                                        <div ng-show="total" style="line-height: 35px;">Showing {{start}} to {{end}} of {{total}} entries</div>
                                   </div> 
                                   <div class="col-md-8 text-right no-padding">

                                        <paging
                                             class="small"
                                             page="orderslistdata.currentPage" 
                                             page-size="orderslistdata.perpage_value" 
                                             total="orderslistdata.total"
                                             adjacent="{{adjacent}}"
                                             dots="{{dots}}"
                                             scroll-top="{{scrollTop}}" 
                                             hide-if-empty="false"
                                             ul-class="{{ulClass}}"
                                             active-class="{{activeClass}}"
                                             disabled-class="{{disabledClass}}"
                                             show-prev-next="true"
                                             paging-action="getOrders(page)">
                                        </paging> 
                                   </div>
                              </div>

                         </div>
                    </div>

               </div>
          </div>
     </div>
</div>