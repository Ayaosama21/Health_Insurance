
import React, { Component } from 'react';
import { ScrollView,View,Text } from 'react-native';
import axios from 'axios';
import DDetails from './DDetails';

class PList extends Component {
  state = { albums: [] };

  componentDidMount() {
    axios.get('https://rallycoding.herokuapp.com/api/music_albums')
      .then(response => this.setState({ albums: response.data }));
  }

  renderAlbums() {
    return this.state.albums.map(album =>
      <DDetails key={album.title} album={album} />
    );
  }
  /*
  renderAlbums() {
    return (<View><Text>{this.Doctors.title}</Text></View>);
  }*/

  /*renderAlbums() {
    return this.state.Doctors.map(Doctor =>
      <DDetails key={Doctor.D_Username} Doctor={Doctor} />
    );
  } */

  render() {
    console.log(this.state);

    return (
      <ScrollView>
        {this.renderAlbums()}
      </ScrollView>
    );
  }
}

export default PList;


