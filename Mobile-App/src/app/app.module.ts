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
import { RequestPage } from '../pages/request/request';
import { EditprofilePage } from '../pages/editprofile/editprofile';

import { HttpClientModule } from '@angular/common/http';
import { UniqueDeviceID } from '@ionic-native/unique-device-id';
import { IonicStorageModule } from '@ionic/storage';
import { ImagePicker } from '@ionic-native/image-picker';
import { Base64 } from '@ionic-native/base64';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { RestProvider } from '../providers/rest/rest';

@NgModule({
  declarations: [
    MyApp,
    StoresPage,
    BranchesPage,PaymentPage,RequestPage,
    TabsPage,LoginPage,ConfirmPhonePage,EditprofilePage,ProfilePage
  ],
  imports: [
    BrowserModule,

    HttpClientModule,
    IonicModule.forRoot(MyApp),
    IonicStorageModule.forRoot()
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    StoresPage,
    BranchesPage,PaymentPage,RequestPage,
    TabsPage,LoginPage,ConfirmPhonePage,EditprofilePage,ProfilePage
  ],
  providers: [
    StatusBar,
    UniqueDeviceID,
    SplashScreen,
    ImagePicker,
    Base64,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    RestProvider
  ]
})
export class AppModule {}
