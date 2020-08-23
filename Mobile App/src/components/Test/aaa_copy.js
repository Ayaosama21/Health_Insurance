import React from 'react';
import { Text, View, Image, Linking } from 'react-native';
import {Card, CardSection, Button} from '../common';

const Aaa = ({ doctor }) => {
  const { id, username, password, gender } = doctor;
  const {
    thumbnailStyle,
    headerContentStyle,
    ContainerStyle,
    headerTextStyle,
    imageStyle
  } = styles;

  return (
    <Card>
      <CardSection>
        <View style={ContainerStyle}>
          <Button>
            {username}
          </Button>
        </View>
      </CardSection>
    </Card>
  );
};

const styles = {
  headerContentStyle: {
    flexDirection: 'column',
    justifyContent: 'space-around'
  },
  headerTextStyle: {
    fontSize: 18
  },
  thumbnailStyle: {
    height: 50,
    width: 50
  },
  ContainerStyle: {
    justifyContent: 'center',
    alignItems: 'center',
    marginLeft: 10,
    marginRight: 10,
    flex: 1
  },
  imageStyle: {
    height: 300,
    flex: 1,
    width: null
  }
};

export default Aaa;