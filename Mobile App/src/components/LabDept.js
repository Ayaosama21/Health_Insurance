import React, { Component } from 'react';
import { Button, CardSection, Card2 } from './common';
import LabView from './LabView';
import { Navigation } from 'react-native-navigation';

class LabDept extends Component {

    DeptChoose = () => {
        Navigation.setRoot(Lab)
      }
      GoToDeptList = (props) => {
            alert(props);
            this.DeptChoose();
    }
    GetAlert =() =>{
        alert('لا يوجد نتائج تحليل')
    }

    render() {
        return (
          
            <Card2>
                <CardSection>
                    <Button onPress={() => this.GetAlert("قلب")}>قلب</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("المسالك البوليه")}>المسالك البوليه</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GoToDeptList("الروماتيزم")}>الروماتيزم</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("العظام")}>العظام</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("النساء")}>النساء</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("الباطنة")}>الباطنة</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GoToDeptList("الاعصاب")}>الاعصاب</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("علاج طبيعي")}>علاج طبيعي</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("جراحة")}>جراحة</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("أطفال")}>أطفال</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("أسنان")}>أسنان</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("جلدية")}>جلدية</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("ممارس")}>ممارس</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("أمراض دم")}>أمراض دم</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("أوعية دموية")}>أوعية دموية</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("كبد")}>كبد</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("كلي")}>كلي</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("رمد")}>رمد</Button>
                </CardSection>
                <CardSection>
                    <Button onPress={() => this.GetAlert("الصدر")}>الصدر</Button>
                </CardSection>
            </Card2>
          
        );
      }
    }
    const styles = {
        container: {
          flex: 1,
          paddingTop: 40
        }}

    const LabRes = () => {
        return (
            <LabView/>
        );
    }
    export default LabDept;

    Navigation.registerComponent('RESULTSVIEW', () => LabRes);

    const Lab = {
        root: { stack : {
        children: [
          {
            component: {
              id: 'RESULTSVIEW',
              name: 'RESULTSVIEW',
              options: {
                topBar: {
                  title: {
                    text: 'نتائج المعمل                               ',
                    fontSize: 30
                  },
                  backButton: {
                    visible: false,
                    color: '#000000'
                  },
                }
              }
            }
          }
        ]
      }}}