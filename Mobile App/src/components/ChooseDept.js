import React, { Component } from 'react';
import { Button, CardSection, Card2 } from './common';
import DList from './DList';
import { Navigation } from 'react-native-navigation';

class ChooseDept extends Component {

    DeptChoose = () => {
        Navigation.setRoot(Reserv)
      }
      GoToDeptList = (props) => {
            alert(props);
            this.DeptChoose();
    }
    GetAlert =() =>{
      alert('لا يوجد اطباء متاحين لهذا الشهر')
  }

    render() {
        return (
          
            <Card2>
                <CardSection>
                    <Button onPress={() => this.GoToDeptList("قلب")}>قلب</Button>
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

    const DocList = () => {
        return (
            <DList/>
        );
    }
    export default ChooseDept;

    Navigation.registerComponent('DocList', () => DocList);

    const Reserv = {
        root: { stack : {
        children: [
          {
            component: {
              id: 'DOCLIST',
              name: 'DocList',
              options: {
                topBar: {
                  title: {
                    text: 'الاطباء                               ',
                    fontSize: 30
                  },
                  backButton: {
                    visible: true,
                    color: '#000000'
                  },
                }
              }
            }
          }
        ]
      }}}