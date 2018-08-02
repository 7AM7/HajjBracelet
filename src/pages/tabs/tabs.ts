import { Component } from '@angular/core';

import { StoresPage } from '../stores/stores';
import { BranchesPage } from '../branches/branches';

@Component({
  templateUrl: 'tabs.html'
})
export class TabsPage {

  tab1Root = StoresPage;
  tab2Root = BranchesPage;
  
  constructor() {

  }
}
