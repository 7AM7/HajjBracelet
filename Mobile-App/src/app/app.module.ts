import { NgModule, ErrorHandler } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';

import { StoresPage } from '../pages/stores/stores';
import { BranchesPage } from '../pages/branches/branches';
import { TabsPage } from '../pages/tabs/tabs';
import { LoginPage } from '../pages/login/login';
import { ConfirmPhonePage } from '../pages/confirm-phone/confirm-phone';
import { ProfilePage } from '../pages/profile/profile';
import { PaymentPage } from '../pages/payment/payment';
import { EditprofilePage } from '../pages/editprofile/editprofile';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

@NgModule({
  declarations: [
    MyApp,
    StoresPage,
    BranchesPage,PaymentPage,
    TabsPage,LoginPage,ConfirmPhonePage,EditprofilePage,ProfilePage
  ],
  imports: [
    BrowserModule,
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    StoresPage,
    BranchesPage,PaymentPage,
    TabsPage,LoginPage,ConfirmPhonePage,EditprofilePage,ProfilePage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler}
  ]
})
export class AppModule {}
