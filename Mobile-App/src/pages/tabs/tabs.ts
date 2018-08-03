import { Component } from '@angular/core';

import { StoresPage } from '../stores/stores';
import { BranchesPage } from '../branches/branches';
import { RequestPage } from '../request/request';

@Component({
  templateUrl: 'tabs.html'
})
export class TabsPage {

  tab1Root = StoresPage;
  tab2Root = BranchesPage;
  tab3Root = RequestPage;
  
  constructor() {

  }
}
