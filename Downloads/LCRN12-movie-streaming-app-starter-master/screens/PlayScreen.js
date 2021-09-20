import React, { useState, useEffect } from "react";
import {
  Text,
  TextInput,
  View,
  Button,
  StatusBar,
  Dimensions,
} from "react-native";
import { NodePlayerView } from "react-native-nodemediaclient";
import ActionButton from "react-native-action-button";

const PlayScreen = ({ navigation, vb }) => {
  const [value, setValue] = useState();
  useEffect(() => {
    return () => {
      vb.stop();
    };
  }, []);
  const win = Dimensions.get("window");
  console.log(this.props);
  return (
    <View style={{ flex: 1 }}>
      <NodePlayerView
        style={{
          flex: 1,
          backgroundColor: "#333",
        }}
        ref={(vp) => {
          vb = vp;
        }}
        inputUrl={
          "rtmp://live.restream.io/pull/play_2827105_47e19a258a68eda90504"
        }
        scaleMode={"ScaleAspectFit"}
        bufferTime={300}
        maxBufferTime={1000}
        autoplay={true}
      />
      <ActionButton
        buttonColor="rgba(231,76,60,1)"
        offsetY={32}
        offsetX={16}
        size={32}
        hideShadow={true}
        buttonText="x"
        verticalOrientation="down"
        onPress={() => {
          vb.stop();
          navigation.goBack();
        }}
      />
    </View>
  );
};

export default PlayScreen;
