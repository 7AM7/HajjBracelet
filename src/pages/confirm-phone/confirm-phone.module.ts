import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { ConfirmPhonePage } from './confirm-phone';

@NgModule({
  declarations: [
    ConfirmPhonePage,
  ],
  imports: [
    IonicPageModule.forChild(ConfirmPhonePage),
  ],
})
export class ConfirmPhonePageModule {}
